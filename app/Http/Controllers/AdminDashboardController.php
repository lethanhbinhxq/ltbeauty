<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function dashboard() {
        $num_completed = Order::where('status', Order::STATUS_COMPLETED)->count();
        $num_processing = Order::where('status', Order::STATUS_PROCESSING)->count();
        $num_cancelled = Order::where('status', Order::STATUS_CANCELLED)->count();
        $sales = Order::sum('total');
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard', compact([
            'num_completed',
            'num_processing',
            'num_cancelled',
            'sales',
            'orders'
        ]));
    }
}
