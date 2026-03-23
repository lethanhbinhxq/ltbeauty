@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm" name="keyword"
                        value="{{ request('keyword') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/post/action') }}" method="POST">
                    @csrf
                    <div class="analytic">
                        <a href="?status=all" class="text-pink">Tất cả <span class="text-muted">({{ $num_all }})</span></a>
                        <a href="?status=public" class="text-pink">Công khai <span
                                class="text-muted">({{ $num_public }})</span></a>
                        <a href="?status=pending" class="text-pink">Chờ duyệt <span
                                class="text-muted">({{ $num_pending }})</span></a>
                        <a href="?status=trash" class="text-pink">Vô hiệu hóa <span
                                class="text-muted">({{ $num_trash }})</span></a>
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
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox" class="form-check-input">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t = 0;
                            @endphp
                            @if ($posts->total() > 0)
                                @foreach ($posts as $post)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input" name="list_check[]" value="{{ $post->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td><img src="{{ asset($post->thumbnail) }}" alt="" width="80"></td>
                                        <td><a href="">{{ $post->title }}</a></td>
                                        <td>{{ $post->cat->name }}</td>
                                        <td>{{ $post->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>
                                        @if($post->status == App\Models\Post::STATUS_PUBLIC)
                                            <td><span class="badge text-bg-success">Công khai</span></td>
                                        @else
                                            <td><span class="badge text-bg-warning">Chờ duyệt</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('admin.post.edit', $post->id) }}"
                                                class="btn btn-success btn-sm rounded-2 text-white" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                                data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                                data-bs-target="#deletePostModal" data-bs-id="{{ $post->id }}"
                                                data-title="{{ $post->title }}"><i class="fa fa-trash"></i></button>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>Không tìm thấy bản ghi</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $posts->appends(request()->query())->links() }}
                </form>
            </div>
        </div>
        @include('admin.post.delete')
        <script src="{{ asset('js/admin.post.js') }}"></script>
    </div>
@endsection