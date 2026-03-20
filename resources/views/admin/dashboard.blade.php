@extends('layouts.admin')

@php
    use App\Models\Order;
@endphp

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-pink mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $num_completed }}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-lavender mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $num_processing }}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-pink-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($sales, 0, '', '.') }}đ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $num_cancelled }}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            {{-- Order table --}}
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
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
                            @php
                            $t = 0;
                            @endphp
                            {{-- ORDER 1 --}}
                            @foreach ($orders as $order)
                            @php
                            $t++;
                            @endphp
                                <tr class="border-top">
                                    <td>
                                        <div class="fw-bold text-center">{{ $t }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $order->code }}</div>
                                        <small class="text-muted">3 sản phẩm</small>
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
                                        <div class="fw-bold text-danger">{{ number_format($order->total, 0, '', '.') }}đ</div>
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
                                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#{{$order->id}}" aria-expanded="false">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-success btn-sm text-white" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm rounded-2 text-white"
                                            data-toggle="tooltip" data-placement="top" title="Delete" data-bs-toggle="modal"
                                            data-bs-target="#deleteOrderModal" data-bs-id="{{ $order->id }}"
                                            data-bs-code="{{ $order->code }}"><i class="fa fa-trash"></i></button>
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
                                                                            {{ number_format($item->total, 0, '', '.') }}đ</td>
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
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>

    </div>
@endsection