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
        if ($request) {
            $orders = Order::where('code', 'like', '%' . $request->keyword . '%')
                ->orWhere('customer_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%');
        }
        $orders = $orders->paginate(10);
        $num_processing = Order::where('status', Order::STATUS_PROCESSING)->count();
        $num_shipping = Order::where('status', Order::STATUS_SHIPPING)->count();
        $num_completed = Order::where('status', Order::STATUS_COMPLETED)->count();
        $num_cancelled = Order::where('status', Order::STATUS_CANCELLED)->count();
        return view('admin.order.show', compact([
            'orders',
            'num_processing',
            'num_shipping',
            'num_completed',
            'num_cancelled'
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
}
