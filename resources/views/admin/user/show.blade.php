@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form class="d-flex" role="search" method="GET" action="">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" name="keyword"
                            value="{{ request('keyword') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/user/action') }}" method="POST">
                    @csrf
                    <div class="analytic">
                        <a href="?status=all" class="text-pink">Tất cả <span class="text-muted">({{ $num_all }})</span></a>
                        <a href="?status=active" class="text-pink">Đang hoạt động <span
                                class="text-muted">({{ $num_active }})</span></a>
                        <a href="?status=pending" class="text-pink">Chờ xác thực <span
                                class="text-muted">({{$num_pending}})</span></a>
                        <a href="?status=blocked" class="text-pink">Bị khóa <span
                                class="text-muted">({{$num_blocked}})</span></a>
                        <a href="?status=trash" class="text-pink">Vô hiệu hóa <span
                                class="text-muted">({{$num_trash}})</span></a>
                    </div>
                    <div class="d-flex align-items-center py-3 gap-2">
                        <select class="form-select w-auto" name="action">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary">
                            Áp dụng
                        </button>
                    </div>
                    <table class="table table-striped table-checkall">
                        @if ($users)
                            @php
                                $t = 0;
                            @endphp
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" class="form-check-input" name="checkall">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Quyền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->total() > 0)
                                    @foreach ($users as $user)
                                        @php
                                            $t++;
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="list_check[]"
                                                    value="{{ $user->id }}">
                                            </td>
                                            <th scope="row">{{$t}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    <a href="{{ route('role.edit', $role->id) }}">
                                                        <span class="badge text-bg-info">{{ $role->name }}</span>
                                                    </a>
                                                @endforeach
                                            </td>
                                            @if($user->status == App\Models\User::STATUS_ACTIVE)
                                                <td><span class="badge text-bg-success">Đang hoạt động</span></td>
                                            @elseif ($user->status == App\Models\User::STATUS_PENDING)
                                                <td><span class="badge text-bg-warning">Chờ xác thực</span></td>
                                            @else
                                                <td><span class="badge text-bg-danger">Bị khóa</span></td>
                                            @endif
                                            <td>{{ $user->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                @if (Auth::id() != $user->id)
                                                    <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                                        data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal" data-bs-id="{{ $user->id }}"
                                                        data-bs-name="{{ $user->name }}"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">Không tìm thấy bản ghi</td>
                                    </tr>
                                @endif

                            </tbody>
                        @endif
                    </table>
                    {{ $users->appends(request()->query())->links() }}

                    @include('admin.user.delete')
                </form>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/admin.user.js') }}"></script>
@endsection