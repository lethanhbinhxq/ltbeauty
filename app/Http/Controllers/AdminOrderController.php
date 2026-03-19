<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function show(Request $request) {
        if ($request) {
            $orders = Order::where('code', 'like', '%' . $request->keyword . '%')
                        ->orWhere('customer_name', 'like', '%' . $request->keyword . '%')
                        ->orWhere('phone', 'like', '%' . $request->keyword . '%');
        }
        $orders = $orders->paginate(10);
        return view('admin.order.show', compact('orders'));
    }
}
