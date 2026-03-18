@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="" class="text-pink">Hết hàng <span class="text-muted">({{ $num_out_of_stock }})</span></a>
                </div>
                <div class="d-flex align-items-center py-3 gap-2">
                    <select class="form-select w-auto">
                        <option>Chọn</option>
                        <option>Tác vụ 1</option>
                        <option>Tác vụ 2</option>
                    </select>

                    <button type="submit" class="btn btn-primary">
                        Áp dụng
                    </button>
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($products as $product)
                            <tr class="">
                                @php
                                    $t++;
                                @endphp
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t }}</td>
                                <td><img src="{{ asset($product->thumbnail) }}" alt="" width="80"></td>
                                <td><a href="#">{{ $product->name }}</a></td>
                                <td>{{ number_format($product->price, 0, '', '.') }}đ</td>
                                <td>{{ $product->cat->name }}</td>
                                <td>{{ $product->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>
                                @if($product->status == App\Models\Product::STATUS_IN_STOCK)
                                    <td><span class="badge text-bg-success">Còn hàng</span></td>
                                @else
                                    <td><span class="badge text-bg-dark">Hết hàng</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="btn btn-success btn-sm rounded-2 text-white" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                        data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteProductModal" data-bs-id="{{ $product->id }}"
                                        data-title="{{ $product->name }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
        @include('admin.product.delete')
        <script src="{{ asset('js/admin.product.js') }}"></script>
    </div>
@endsection