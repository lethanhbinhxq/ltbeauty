<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function show()
    {
        $roles = Role::paginate(10);
        return view('admin.role.show', compact('roles'));
    }
}
