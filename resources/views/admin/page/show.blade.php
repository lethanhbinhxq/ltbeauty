@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách trang</h5>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
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
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td scope="row">1</td>
                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                            <td><a href="">Giá xăng sẽ tiếp tục tăng ở mức cao, lần thứ 4 liên tiếp vào ngày mai?</a></td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td scope="row">2</td>
                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                            <td><a href="#">Xuất hiện ứng dụng ngân hàng Việt Nam leo lên vị trí Top 1 trên App Store</a>
                            </td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td scope="row">3</td>
                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                            <td><a href="">Giá xăng sẽ tiếp tục tăng ở mức cao, lần thứ 4 liên tiếp vào ngày mai?</a></td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>4</td>
                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>
                            <td><a href="">Xuất hiện ứng dụng ngân hàng Việt Nam leo lên vị trí Top 1 trên App Store</a>
                            </td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td scope="row">5</td>
                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>

                            <td><a href="">Giá xăng sẽ tiếp tục tăng ở mức cao, lần thứ 4 liên tiếp vào ngày mai?</a></td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td scope="row">6</td>

                            <td><img src="http://via.placeholder.com/80X80" alt=""></td>

                            <td><a href="#">Xuất hiện ứng dụng ngân hàng Việt Nam leo lên vị trí Top 1 trên App Store</a>
                            </td>
                            <td>Tin nóng</td>
                            <td>26:06:2020 14:00</td>
                            <td><button class="btn btn-success btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" type="button" data-toggle="tooltip"
                                    data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Prev</span>
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