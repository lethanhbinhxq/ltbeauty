@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('admin/user/insert') }}">
                @csrf

                <div class="mb-3">
                    <label for="name">Họ và tên</label>
                    <input
                        class="form-control @error('name') is-invalid @enderror"
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input
                        class="form-control @error('email') is-invalid @enderror"
                        type="text"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Mật khẩu</label>
                    <input
                        class="form-control @error('password') is-invalid @enderror"
                        type="password"
                        name="password"
                        id="password"
                    >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                    >
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Nhóm quyền</label>
                    <select class="form-control">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection