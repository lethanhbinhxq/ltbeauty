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

                    <div class="mb-3">
                        <label for="name">Họ và tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="role">Quyền</label>
                        @php
                            $selectedRoles = $user->roles->pluck('id')->toArray();
                            $options = $roles->pluck('name', 'id')->toArray();
                        @endphp
                        <select class="form-control" name="roles[]" id="role" multiple>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $selectedRoles) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password">Mật khẩu mới</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            id="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    </div>

                    <div class="mb-3">
                        <label for="status">Trạng thái</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">-----Chọn trạng thái-----</option>
                            <option value="{{ App\Models\User::STATUS_ACTIVE }}" {{ old('status', $user->status) == App\Models\User::STATUS_ACTIVE ? 'selected' : '' }}>
                                Đang hoạt động
                            </option>
                            <option value="{{ App\Models\User::STATUS_PENDING }}" {{ old('status', $user->status) == App\Models\User::STATUS_PENDING ? 'selected' : '' }}>
                                Chờ duyệt
                            </option>
                            <option value="{{ App\Models\User::STATUS_BLOCKED }}" {{ old('status', $user->status) == App\Models\User::STATUS_BLOCKED ? 'selected' : '' }}>
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