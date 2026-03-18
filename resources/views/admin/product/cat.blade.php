@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/admin/product/cat/add') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">------Chọn danh mục------</option>
                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status1"
                                        value="{{App\Models\PostCat::STATUS_PENDING}}" checked>
                                    <label class="form-check-label" for="status1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status2"
                                        value="{{App\Models\PostCat::STATUS_PUBLIC}}">
                                    <label class="form-check-label" for="status2">
                                        Công khai
                                    </label>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Danh mục cha</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($cats_paginate as $cat)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $t }}</th>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->parent ? $cat->parent->name : '-' }}</td>
                                        @if($cat->status == App\Models\PostCat::STATUS_PUBLIC)
                                            <td><span class="badge text-bg-success">Công khai</span></td>
                                        @else
                                            <td><span class="badge text-bg-warning">Chờ duyệt</span></td>
                                        @endif

                                        <td>{{ $cat->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>

                                        <td>
                                            <button class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit" data-bs-toggle="modal"
                                                data-bs-target="#editProductCatModal" data-bs-id="{{ $cat->id }}"
                                                data-bs-name="{{ $cat->name }}" data-bs-status="{{ $cat->status }}"
                                                data-bs-parent-id="{{ $cat->parent_id }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                                data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteProductCatModal" data-bs-id="{{ $cat->id }}"
                                                data-bs-name="{{ $cat->name }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $cats_paginate->links() }}
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('admin.product.catDelete')--}}
        @include('admin.product.catEdit')

        <script src="{{ asset('js/admin.productCat.js') }}"></script>
    </div>
@endsection