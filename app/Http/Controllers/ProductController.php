<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function add() {
        return view('admin.product.add');
    }

    public function show() {
        return view('admin.product.show');
    }

    public function cat() {
        return view('admin.product.cat');
    }
}
