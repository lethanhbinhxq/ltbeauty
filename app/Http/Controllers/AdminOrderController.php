<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function show() {
        $orders = Order::paginate(10);
        return view('admin.order.show', compact('orders'));
    }
}
