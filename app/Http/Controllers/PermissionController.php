<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function permission() {
        return view('admin.permission.permission');
    }

    public function addRole() {
        return view('admin.permission.addRole');
    }

    public function showRole() {
        return view('admin.permission.showRole');
    }
}
