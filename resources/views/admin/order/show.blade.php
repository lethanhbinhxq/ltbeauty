@extends('layouts.admin')

@php
    use App\Models\Order;
@endphp

@section('content')
    <div id="content" class="container-fluid py-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                    <div>
                        <h5 class="m-0 fw-bold">Danh sách đơn hàng</h5>
                    </div>

                    <form class="d-flex" role="search" method="GET" action="">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Tìm kiếm..." name="keyword"
                                value="{{ request('keyword') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-magnifying-glass me-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/order/action') }}" method="POST">
                    @csrf
                    {{-- Filter links --}}
                    <div class="d-flex flex-wrap gap-2 mb-3 analytic">
                        <a href="?status=all" class="text-pink">Tất cả <span class="text-muted">({{ $num_all }})</span></a>
                        <a href="?status=processing" class="text-pink">Đang xử lý <span
                                class="text-muted">({{ $num_processing }})</span></a>
                        <a href="?status=shipping" class="text-pink">Đang giao <span
                                class="text-muted">({{ $num_shipping }})</span></a>
                        <a href="?status=completed" class="text-pink">Hoàn thành <span
                                class="text-muted">({{ $num_completed }})</span></a>
                        <a href="?status=cancelled" class="text-pink">Đã hủy <span
                                class="text-muted">({{ $num_cancelled }})</span></a>
                        <a href="?status=trash" class="text-pink">Vô hiệu hóa <span
                                class="text-muted">({{ $num_trash }})</span></a>
                    </div>

                    {{-- Bulk action --}}
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 mb-3">
                        <select class="form-select w-auto" name="action">
                            <option>Chọn tác vụ</option>
                            @foreach ($list_act as $k => $act)
                                <option value="{{ $k }}">{{ $act }}</option>
                            @endforeach
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
                                @if ($orders->total() > 0)
                                    {{-- ORDER 1 --}}
                                    @foreach ($orders as $order)
                                        <tr class="border-top">
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="list_check[]" value="{{ $order->id }}">
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $order->code }}</div>
                                                <small class="text-muted">{{ $order->items->count() }} sản phẩm</small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $order->customer_name }}</div>
                                                <div class="text-muted small">{{ $order->phone }}</div>
                                                <div class="text-muted small">{{ $order->email }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $order->items->first()->product->name }}</div>
                                                <small class="text-muted">và {{ $order->items->count() - 1 }} sản phẩm khác</small>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-danger">{{ number_format($order->total, 0, '', '.') }}đ
                                                </div>
                                            </td>

                                            <td>
                                                {{-- Payment method --}}
                                                @if ($order->payment_method === Order::PAYMENT_COD)
                                                    <span class="badge bg-info-subtle text-info border">COD</span>
                                                @elseif ($order->payment_method === Order::PAYMENT_BANK)
                                                    <span class="badge bg-success-subtle text-success border">Chuyển khoản</span>
                                                @endif

                                                {{-- Payment status --}}
                                                <div class="small mt-1">
                                                    @if ($order->payment_status === Order::PAYMENT_PAID)
                                                        <span class="text-success">Đã thanh toán</span>
                                                    @elseif ($order->payment_status === Order::PAYMENT_UNPAID)
                                                        <span class="text-warning">Chưa thanh toán</span>
                                                    @elseif ($order->payment_status === Order::PAYMENT_REFUNDED)
                                                        <span class="text-danger">Đã hoàn tiền</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                @if ($order->status === Order::STATUS_PROCESSING)
                                                    <span class="badge bg-warning text-dark">Đang xử lý</span>
                                                @elseif ($order->status === Order::STATUS_SHIPPING)
                                                    <span class="badge bg-primary">Đang giao</span>
                                                @elseif ($order->status === Order::STATUS_COMPLETED)
                                                    <span class="badge bg-success">Hoàn thành</span>
                                                @elseif ($order->status === Order::STATUS_CANCELLED)
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @endif
                                            </td>

                                            <td>{{ $order->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>

                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-secondary" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#{{$order->id}}"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('admin.order.edit', $order->id) }}"
                                                        class="btn btn-success btn-sm text-white" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                                        data-bs-toggle="modal" data-bs-target="#deleteOrderModal"
                                                        data-bs-id="{{ $order->id }}" data-bs-code="{{ $order->code }}"><i
                                                            class="fa fa-trash"></i></button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse bg-light" id="{{ $order->id }}">
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
                                                                        @foreach ($order->items as $item)
                                                                            <tr>
                                                                                <td>{{ $item->product->name }}</td>
                                                                                <td>{{ number_format($item->product_price, 0, '', '.') }}đ
                                                                                </td>
                                                                                <td>{{ $item->qty }}</td>
                                                                                <td class="fw-semibold">
                                                                                    {{ number_format($item->total, 0, '', '.') }}đ
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-4">
                                                            <h6 class="fw-bold mb-3">Thông tin đơn hàng</h6>
                                                            <ul class="list-group list-group-flush border rounded">
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Tạm tính</span>
                                                                    <strong>{{ number_format($order->subtotal, 0, '', '.') }}đ</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Phí vận chuyển</span>
                                                                    <strong>{{ number_format($order->shipping_fee, 0, '', '.') }}đ</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Giảm giá</span>
                                                                    <strong>-{{ number_format($order->discount, 0, '', '.') }}đ</strong>
                                                                </li>
                                                                <li class="list-group-item d-flex justify-content-between">
                                                                    <span>Tổng cộng</span>
                                                                    <strong
                                                                        class="text-danger">{{ number_format($order->total, 0, '', '.') }}đ</strong>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="fw-semibold mb-1">Địa chỉ giao hàng</div>
                                                                    <div class="text-muted small">
                                                                        {{ $order->address }}
                                                                    </div>
                                                                </li>
                                                                @if ($order->note)
                                                                    <li class="list-group-item">
                                                                        <div class="fw-semibold mb-1">Ghi chú</div>
                                                                        <div class="text-muted small">
                                                                            {{ $order->note }}
                                                                        </div>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">Không tìm thấy bản ghi</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    {{ $orders->appends(request()->query())->links() }}
                </form>
            </div>
        </div>
        @include('admin.order.delete')
        <script src="{{ asset('js/admin.order.js') }}"></script>
    </div>
@endsection