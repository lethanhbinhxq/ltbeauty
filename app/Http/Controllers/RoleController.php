<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    //
    public function show()
    {
        if (!Gate::allows('role.view')) {
            abort(403);
        }
        $roles = Role::paginate(10);
        return view('admin.role.show', compact('roles'));
    }

    public function add()
    {
        if (!Gate::allows('role.add')) {
            abort(403);
        }
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('role.add')) {
            abort(403);
        }
        $request->validate(
            [
                'name' => 'required|max:255|unique:roles,name',
                'description' => 'required',
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id',
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'array' => ':attribute phải là một mảng.',
                'exists' => ':attribute không hợp lệ.',
            ],
            [
                'name' => 'Tên vai trò',
                'description' => 'Mô tả',
                'permission_id' => 'Danh sách quyền',
            ]
        );

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $role->permissions()->attach($request->permission_id);
        return redirect(route('role.show'))->with('success', 'Bạn đã thêm vai trò mới thành công');
    }

    public function edit($id)
    {
        if (!Gate::allows('role.edit')) {
            abort(403);
        }
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $role = Role::find($id);
        return view('admin.role.edit', compact('permissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        if (!Gate::allows('role.edit')) {
            abort(403);
        }
        $request->validate(
            [
                'name' => 'required|max:255|unique:roles,name,' . $id,
                'description' => 'required',
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id',
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'array' => ':attribute phải là một mảng.',
                'exists' => ':attribute không hợp lệ.',
            ],
            [
                'name' => 'Tên vai trò',
                'description' => 'Mô tả',
                'permission_id' => 'Danh sách quyền',
            ]
        );

        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect(route('role.show'))->with('success', 'Bạn đã cập nhật vai trò thành công');
    }

    public function delete($id)
    {
        if (!Gate::allows('role.delete')) {
            abort(403);
        }
        $role = Role::find($id);
        $role->delete();

        return redirect('admin/role')->with('success', 'Xóa vai trò thành công.');
    }
}
