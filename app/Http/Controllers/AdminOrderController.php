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
        return view('admin.order.show', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.order')
            ->with('success', 'Cập nhật đơn hàng thành công');
    }
}
