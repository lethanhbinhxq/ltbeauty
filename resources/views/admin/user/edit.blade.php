@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa người dùng
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('admin/user/update', $user->id) }}">
                @csrf

                {{-- NAME --}}
                <div class="mb-3">
                    <label for="name">Họ và tên</label>
                    <input
                        class="form-control @error('name') is-invalid @enderror"
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                    >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div class="mb-3">
                    <label for="role">Quyền</label>
                    <select class="form-control" name="role" id="role">
                        <option value="">-----Chọn quyền-----</option>
                        <option value="1">Danh mục 1</option>
                        <option value="2">Danh mục 2</option>
                        <option value="3">Danh mục 3</option>
                        <option value="4">Danh mục 4</option>
                    </select>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">-----Chọn trạng thái-----</option>
                        <option value="{{ App\Models\User::STATUS_ACTIVE }}"
                            {{ $user->status == App\Models\User::STATUS_ACTIVE ? 'selected' : '' }}>
                            Đang hoạt động
                        </option>
                        <option value="{{ App\Models\User::STATUS_PENDING }}"
                            {{ $user->status == App\Models\User::STATUS_PENDING ? 'selected' : '' }}>
                            Chờ duyệt
                        </option>
                        <option value="{{ App\Models\User::STATUS_BLOCKED }}"
                            {{ $user->status == App\Models\User::STATUS_BLOCKED ? 'selected' : '' }}>
                            Bị khóa
                        </option>
                    </select>

                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection