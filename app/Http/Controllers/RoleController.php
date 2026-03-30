<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
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

    public function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required|string',
            ],
            [
                'required' => ':attribute không được để trống.',
            ],
            [
                'name' => 'Tên vai trò',
                'description' => 'Mô tả',
            ]
        );

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect(route('role.show'))->with('success', 'Bạn đã thêm vai trò mới thành công');
    }
}
