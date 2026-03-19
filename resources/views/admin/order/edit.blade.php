@extends('layouts.admin')

@php
    use App\Models\Order;
@endphp

@section('content')
    <div id="content" class="container-fluid py-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold">Chi tiết đơn hàng: {{ $order->code }}</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">

                    {{-- LEFT: PRODUCT LIST --}}
                    <div class="col-12 col-lg-8">
                        <h6 class="fw-bold mb-3">Danh sách sản phẩm</h6>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
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
                                            <td>
                                                {{ $item->product?->name ?? 'Sản phẩm đã bị xóa' }}
                                            </td>
                                            <td>
                                                {{ number_format($item->product_price, 0, '', '.') }}đ
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

                    {{-- RIGHT: ORDER INFO --}}
                    <div class="col-12 col-lg-4">
                        <h6 class="fw-bold mb-3">Thông tin đơn hàng</h6>

                        <ul class="list-group list-group-flush border rounded mb-3">
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
                                <strong class="text-danger">
                                    {{ number_format($order->total, 0, '', '.') }}đ
                                </strong>
                            </li>
                        </ul>

                        <div class="mb-3">
                            <label class="fw-semibold">Khách hàng</label>
                            <div>{{ $order->customer_name }}</div>
                            <div class="text-muted small">{{ $order->phone }}</div>
                            <div class="text-muted small">{{ $order->email }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-semibold">Địa chỉ</label>
                            <div class="text-muted small">{{ $order->address }}</div>
                        </div>

                        @if ($order->note)
                            <div class="mb-3">
                                <label class="fw-semibold">Ghi chú</label>
                                <div class="text-muted small">{{ $order->note }}</div>
                            </div>
                        @endif

                        {{-- FORM UPDATE --}}
                        <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="fw-semibold">Trạng thái đơn</label>
                                <select name="status" class="form-select">
                                    <option value="{{ Order::STATUS_PROCESSING }}"
                                        {{ $order->status == Order::STATUS_PROCESSING ? 'selected' : '' }}>
                                        Đang xử lý
                                    </option>
                                    <option value="{{ Order::STATUS_SHIPPING }}"
                                        {{ $order->status == Order::STATUS_SHIPPING ? 'selected' : '' }}>
                                        Đang giao
                                    </option>
                                    <option value="{{ Order::STATUS_COMPLETED }}"
                                        {{ $order->status == Order::STATUS_COMPLETED ? 'selected' : '' }}>
                                        Hoàn thành
                                    </option>
                                    <option value="{{ Order::STATUS_CANCELLED }}"
                                        {{ $order->status == Order::STATUS_CANCELLED ? 'selected' : '' }}>
                                        Đã hủy
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Trạng thái thanh toán</label>
                                <select name="payment_status" class="form-select">
                                    <option value="{{ Order::PAYMENT_UNPAID }}"
                                        {{ $order->payment_status == Order::PAYMENT_UNPAID ? 'selected' : '' }}>
                                        Chưa thanh toán
                                    </option>
                                    <option value="{{ Order::PAYMENT_PAID }}"
                                        {{ $order->payment_status == Order::PAYMENT_PAID ? 'selected' : '' }}>
                                        Đã thanh toán
                                    </option>
                                    <option value="{{ Order::PAYMENT_REFUNDED }}"
                                        {{ $order->payment_status == Order::PAYMENT_REFUNDED ? 'selected' : '' }}>
                                        Đã hoàn tiền
                                    </option>
                                </select>
                            </div>

                            <button class="btn btn-primary w-100">
                                Cập nhật đơn hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection