@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid py-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <h5 class="m-0 fw-bold">Danh sách đơn hàng</h5>
                    </div>

                    <form class="d-flex" role="search">
                        <div class="input-group">
                            <input class="form-control" type="search"
                                placeholder="Tìm kiếm...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass me-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                {{-- Filter links --}}
                <div class="d-flex flex-wrap gap-2 mb-3 analytic">
                    <a href="" class="text-pink">Đang xử lý <span class="text-muted">(10)</span></a>
                    <a href="" class="text-pink">Hoàn thành <span class="text-muted">(20)</span></a>
                    <a href="" class="text-pink">Đã hủy <span class="text-muted">(5)</span></a>
                </div>

                {{-- Bulk action --}}
                <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 mb-3">
                    <select class="form-select w-auto">
                        <option>Chọn tác vụ</option>
                        <option>Xác nhận đơn</option>
                        <option>Chuyển đang giao</option>
                        <option>Hoàn thành</option>
                        <option>Hủy đơn</option>
                        <option>Xóa tạm</option>
                    </select>

                    <button type="submit" class="btn btn-primary">
                        Áp dụng
                    </button>
                </div>

                {{-- Order table --}}
                <div class="table-responsive">
                    <table class="table table-checkall align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" name="checkall" class="form-check-input">
                                </th>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tóm tắt đơn</th>
                                <th>Tổng tiền</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                                <th class="text-center">Chi tiết</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ORDER 1 --}}
                            <tr class="border-top">
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="fw-bold">#DH1212</div>
                                    <small class="text-muted">3 sản phẩm</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Phan Văn Cương</div>
                                    <div class="text-muted small">0988859692</div>
                                    <div class="text-muted small">phanvancuong@gmail.com</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Samsung Galaxy A51</div>
                                    <small class="text-muted">và 2 sản phẩm khác</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-danger">15.580.000₫</div>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info border">COD</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">Đang xử lý</span>
                                </td>
                                <td>
                                    <div>26/06/2020 14:00</div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#orderDetail1212" aria-expanded="false">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" class="btn btn-success btn-sm text-white" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm text-white" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse bg-light" id="orderDetail1212">
                                <td colspan="10">
                                    <div class="p-3">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-8">
                                                <h6 class="fw-bold mb-3">Danh sách sản phẩm</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th width="120">Đơn giá</th>
                                                                <th width="100">Số lượng</th>
                                                                <th width="140">Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Samsung Galaxy A51 (8GB/128GB)</td>
                                                                <td>7.790.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">7.790.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tai nghe Bluetooth Samsung</td>
                                                                <td>1.500.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">1.500.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ốp lưng Galaxy A51</td>
                                                                <td>290.000₫</td>
                                                                <td>2</td>
                                                                <td class="fw-semibold">580.000₫</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <h6 class="fw-bold mb-3">Thông tin đơn hàng</h6>
                                                <ul class="list-group list-group-flush border rounded">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tạm tính</span>
                                                        <strong>9.870.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Phí vận chuyển</span>
                                                        <strong>30.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Giảm giá</span>
                                                        <strong>-0₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tổng cộng</span>
                                                        <strong class="text-danger">9.900.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="fw-semibold mb-1">Địa chỉ giao hàng</div>
                                                        <div class="text-muted small">
                                                            12 Nguyễn Trãi, Quận 5, TP.HCM
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="fw-semibold mb-1">Ghi chú</div>
                                                        <div class="text-muted small">
                                                            Giao giờ hành chính, gọi trước khi giao.
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- ORDER 2 --}}
                            <tr class="border-top">
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="fw-bold">#DH1213</div>
                                    <small class="text-muted">2 sản phẩm</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Minh Anh</div>
                                    <div class="text-muted small">0868873382</div>
                                    <div class="text-muted small">minhanh@gmail.com</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">Samsung Galaxy A51</div>
                                    <small class="text-muted">và 1 sản phẩm khác</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-danger">8.290.000₫</div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border">Đã thanh toán</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Hoàn thành</span>
                                </td>
                                <td>
                                    <div>26/06/2020 14:00</div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#orderDetail1213" aria-expanded="false">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" class="btn btn-success btn-sm text-white" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm text-white" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse bg-light" id="orderDetail1213">
                                <td colspan="10">
                                    <div class="p-3">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-8">
                                                <h6 class="fw-bold mb-3">Danh sách sản phẩm</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th width="120">Đơn giá</th>
                                                                <th width="100">Số lượng</th>
                                                                <th width="140">Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Samsung Galaxy A51 (8GB/128GB)</td>
                                                                <td>7.790.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">7.790.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dán cường lực Galaxy A51</td>
                                                                <td>500.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">500.000₫</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <h6 class="fw-bold mb-3">Thông tin đơn hàng</h6>
                                                <ul class="list-group list-group-flush border rounded">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tạm tính</span>
                                                        <strong>8.290.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Phí vận chuyển</span>
                                                        <strong>0₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tổng cộng</span>
                                                        <strong class="text-danger">8.290.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="fw-semibold mb-1">Địa chỉ giao hàng</div>
                                                        <div class="text-muted small">
                                                            45 Lê Lợi, Quận 1, TP.HCM
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- ORDER 3 --}}
                            <tr class="border-top">
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="fw-bold">#DH1214</div>
                                    <small class="text-muted">4 sản phẩm</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">Trần Thu Hằng</div>
                                    <div class="text-muted small">0234343545</div>
                                    <div class="text-muted small">thuhang@gmail.com</div>
                                </td>
                                <td>
                                    <div class="fw-semibold">iPhone 11 Pro Max 64GB</div>
                                    <small class="text-muted">và 3 sản phẩm khác</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-danger">31.490.000₫</div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border">Đã thanh toán</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Hoàn thành</span>
                                </td>
                                <td>
                                    <div>26/06/2020 14:00</div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-secondary" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#orderDetail1214" aria-expanded="false">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="#" class="btn btn-success btn-sm text-white" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm text-white" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse bg-light" id="orderDetail1214">
                                <td colspan="10">
                                    <div class="p-3">
                                        <div class="row g-4">
                                            <div class="col-12 col-lg-8">
                                                <h6 class="fw-bold mb-3">Danh sách sản phẩm</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm align-middle mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Sản phẩm</th>
                                                                <th width="120">Đơn giá</th>
                                                                <th width="100">Số lượng</th>
                                                                <th width="140">Thành tiền</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Điện thoại iPhone 11 Pro Max 64GB</td>
                                                                <td>29.490.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">29.490.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>AirPods 2</td>
                                                                <td>3.500.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">3.500.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ốp lưng iPhone</td>
                                                                <td>300.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">300.000₫</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Sạc nhanh 20W</td>
                                                                <td>700.000₫</td>
                                                                <td>1</td>
                                                                <td class="fw-semibold">700.000₫</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <h6 class="fw-bold mb-3">Thông tin đơn hàng</h6>
                                                <ul class="list-group list-group-flush border rounded">
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tạm tính</span>
                                                        <strong>33.990.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Phí vận chuyển</span>
                                                        <strong>30.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Giảm giá</span>
                                                        <strong>-2.530.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span>Tổng cộng</span>
                                                        <strong class="text-danger">31.490.000₫</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="fw-semibold mb-1">Địa chỉ giao hàng</div>
                                                        <div class="text-muted small">
                                                            88 Điện Biên Phủ, Bình Thạnh, TP.HCM
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <nav aria-label="Page navigation example" class="mt-4">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sau</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection