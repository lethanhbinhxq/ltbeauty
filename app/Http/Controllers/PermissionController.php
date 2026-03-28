<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.permission.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
            ],
            [
                'name' => 'Tên quyền',
                'slug' => 'Slug',
            ]
        );

        Permission::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect(route('permission.add'))->with('success', 'Bạn đã thêm quyền mới thành công');
    }

    public function edit($id)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact([
            'permissions',
            'permission'
        ]));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
            ],
            [
                'name' => 'Tên quyền',
                'slug' => 'Slug',
            ]
        );

        $permission = Permission::find($id);
        $permission->name =  $request->name;
        $permission->slug =  $request->slug;
        $permission->description =  $request->description;
        $permission->save();

        return redirect(route('permission.add'))->with('success', 'Bạn đã cập nhật quyền thành công');
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect('admin/permission/add')->with('success', 'Xóa quyền thành công.');
    }
}
