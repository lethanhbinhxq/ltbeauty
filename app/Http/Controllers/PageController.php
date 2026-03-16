<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function add() {
        return view('admin.page.add');
    }

    public function show() {
        return view("admin.page.show");
    }
}
