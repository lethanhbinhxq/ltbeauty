<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function add() {
        return view('admin.post.add');
    }

    public function show() {
        return view('admin.post.show');
    }

    public function cat() {
        return view('admin.post.cat');
    }
}
