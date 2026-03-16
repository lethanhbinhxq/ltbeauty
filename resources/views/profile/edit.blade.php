@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">

    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            Cập nhật thông tin cá nhân
        </div>
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header font-weight-bold">
            Đổi mật khẩu
        </div>
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card">
        <div class="card-header font-weight-bold text-danger">
            Xóa tài khoản
        </div>
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection