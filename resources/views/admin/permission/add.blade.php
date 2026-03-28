@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm quyền
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Tên quyền</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                    id="name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug"
                                    id="slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" type="text" name="description"
                                    id="description">{{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách quyền
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($permissions as $module => $modulePermission)
                                    <tr>
                                        <td scope="row"></td>
                                        <td><strong>Module {{ ucfirst($module) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($modulePermission as $permission)
                                        <tr>
                                            <td scope="row">{{ $t++ }}</td>
                                            <td>|---{{ $permission->name }}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <a href="{{ route('permission.edit', $permission->id) }}"
                                                    class="btn btn-success btn-sm rounded-2 text-white" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                                    data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                                    data-bs-target="#deletePermissionModal" data-bs-id="{{ $permission->id }}"
                                                    data-bs-name="{{ $permission->name }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.permission.delete')
        <script src="{{ asset('js/admin.permission.js') }}"></script>
    </div>
@endsection