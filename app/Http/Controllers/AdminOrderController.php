<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function show(Request $request)
    {
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'processing') {
                $list_act['shipping'] = 'Đang giao';
                $list_act['completed'] = 'Hoàn thành';
                $list_act['cancelled'] = 'Đã hủy';
                $orders = Order::where('status', 'processing');
            } elseif ($request->status == 'shipping') {
                $list_act['processing'] = 'Đang xử lý';
                $list_act['completed'] = 'Hoàn thành';
                $list_act['cancelled'] = 'Đã hủy';
                $orders = Order::where('status', 'shipping');
            } elseif ($request->status == 'completed') {
                $list_act['processing'] = 'Đang xử lý';
                $list_act['shipping'] = 'Đang giao';
                $list_act['cancelled'] = 'Đã hủy';
                $orders = Order::where('status', 'completed');
            } elseif ($request->status == 'cancelled') {
                $list_act['processing'] = 'Đang xử lý';
                $list_act['shipping'] = 'Đang giao';
                $list_act['completed'] = 'Hoàn thành';
                $orders = Order::where('status', 'cancelled');
            } else {
                $list_act = [
                    'permanentlyDelete' => "Xóa vĩnh viễn",
                    'restore' => 'Khôi phục'
                ];
                $orders = Order::onlyTrashed();
            }
        } else {
            $orders = Order::where('code', 'like', '%' . $request->keyword . '%')
                ->orWhere('customer_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%');
        }
        $orders = $orders->orderBy('created_at', 'desc')->paginate(10);
        $num_all = Order::count();
        $num_processing = Order::where('status', Order::STATUS_PROCESSING)->count();
        $num_shipping = Order::where('status', Order::STATUS_SHIPPING)->count();
        $num_completed = Order::where('status', Order::STATUS_COMPLETED)->count();
        $num_cancelled = Order::where('status', Order::STATUS_CANCELLED)->count();
        $num_trash = Order::onlyTrashed()->count();
        return view('admin.order.show', compact([
            'orders',
            'num_all',
            'num_processing',
            'num_shipping',
            'num_completed',
            'num_cancelled',
            'num_trash',
            'list_act'
        ]));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.order')
            ->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function destroy($id)
    {
        $page = Order::find($id);
        $page->delete();

        return redirect('admin/order')->with('success', 'Xóa đơn hàng thành công.');
    }

    public function action(Request $request) {
        $action = $request->action;
        $list_check = $request->list_check;

        if (!empty($list_check)) {
            if ($action == 'processing') {
                Order::whereIn('id', $list_check)
                    ->update(['status' => Order::STATUS_PROCESSING]);
                return redirect('admin/order')->with('success', 'Bạn đã cập nhật đang xử lý thành công!');
            } elseif ($action == 'shipping') {
                Order::whereIn('id', $list_check)
                    ->update(['status' => Order::STATUS_SHIPPING]);
                return redirect('admin/order')->with('success', 'Bạn đã cập nhật đang giao thành công!');
            } elseif ($action == 'completed') {
                Order::whereIn('id', $list_check)
                    ->update(['status' => Order::STATUS_COMPLETED]);
                return redirect('admin/order')->with('success', 'Bạn đã cập nhật hoàn thành thành công!');
            } elseif ($action == 'cancelled') {
                Order::whereIn('id', $list_check)
                    ->update(['status' => Order::STATUS_CANCELLED]);
                return redirect('admin/order')->with('success', 'Bạn đã cập nhật hủy thành công!');
            } elseif ($action == 'delete') {
                Order::destroy($list_check);
                return redirect('admin/order')->with('success', 'Bạn đã xóa thành công!');
            } elseif ($action == 'restore') {
                Order::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect('admin/order')->with('success', 'Bạn đã khôi phục thành công!');
            } elseif ($action == 'permanentlyDelete') {
                Order::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect('admin/order')->with('success', 'Bạn đã xóa vĩnh viễn thành công!');
            }
        }
        return redirect('admin/order');
    }
}
