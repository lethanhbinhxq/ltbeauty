@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
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
                    <a href="" class="text-pink">Trạng thái 1<span class="text-muted">(10)</span></a>
                    <a href="" class="text-pink">Trạng thái 2<span class="text-muted">(5)</span></a>
                    <a href="" class="text-pink">Trạng thái 3<span class="text-muted">(20)</span></a>
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
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>1</td>
                            <td>1212</td>
                            <td>
                                Phan Văn Cương <br>
                                0988859692
                            </td>
                            <td><a href="#">Samsung Galaxy A51 (8GB/128GB)</a></td>
                            <td>1</td>
                            <td>7.790.000₫</td>
                            <td><span class="badge text-bg-warning">Đang xử lý</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>2</td>
                            <td>1213</td>
                            <td>
                                Minh Anh <br>
                                0868873382
                            </td>
                            <td><a href="#">Samsung Galaxy A51 (8GB/128GB)</a></td>
                            <td>1</td>
                            <td>7.790.000₫</td>
                            <td><span class="badge text-bg-success">Hoàn thành</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>3</td>
                            <td>1214</td>
                            <td>
                                Trần Thu Hằng <br>
                                0234343545
                            </td>
                            <td><a href="#">Điện thoại iPhone 11 Pro Max 64GB</a></td>
                            <td>1</td>
                            <td>29.490.000₫</td>
                            <td><span class="badge text-bg-success">Hoàn thành</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>4</td>
                            <td>1212</td>
                            <td>
                                Tuấn Anh <br>
                                091236768
                            </td>
                            <td><a href="#">Apple MacBook Pro Touch 2020 i5 512GB</a></td>
                            <td>1</td>
                            <td>47.990.000₫</td>
                            <td><span class="badge text-bg-warning">Đang xử lý</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>5</td>
                            <td>1214</td>
                            <td>
                                Trần Thu Hằng <br>
                                0234343545
                            </td>
                            <td><a href="#">Điện thoại iPhone 11 Pro Max 64GB</a></td>
                            <td>1</td>
                            <td>29.490.000₫</td>
                            <td><span class="badge text-bg-success">Hoàn thành</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>6</td>
                            <td>1212</td>
                            <td>
                                Tuấn Anh <br>
                                091236768
                            </td>
                            <td><a href="#">Apple MacBook Pro Touch 2020 i5 512GB</a></td>
                            <td>1</td>
                            <td>47.990.000₫</td>
                            <td><span class="badge text-bg-success">Hoàn thành</span></td>
                            <td>26:06:2020 14:00</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-sm rounded-2 text-white" type="button"
                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Trước</span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection