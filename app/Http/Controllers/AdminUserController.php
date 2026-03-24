<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    //
    public function add()
    {
        return view('admin.user.add');
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'required' => ':attribute không được để trống.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã tồn tại.',
                'min' => ':attribute phải có ít nhất :min ký tự.',
                'confirmed' => 'Mật khẩu xác nhận không khớp.',
            ],
            [
                'name' => 'Họ và tên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => User::STATUS_PENDING,
        ]);

        return redirect('admin/user')->with('success', 'Thêm người dùng thành công');
    }

    public function show(Request $request)
    {
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'active') {
                $list_act['pending'] = 'Chờ duyệt';
                $list_act['blocked'] = 'Bị khóa';
                $users = User::where('status', 'active');
            } elseif ($request->status == 'pending') {
                $list_act['active'] = 'Đang hoạt động';
                $list_act['blocked'] = 'Bị khóa';
                $users = User::where('status', 'pending');
            } elseif ($request->status == 'blocked') {
                $list_act['active'] = 'Đang hoạt động';
                $list_act['pending'] = 'Chờ duyệt';
                $users = User::where('status', 'blocked');
            } else {
                $list_act = [
                    'permanentlyDelete' => "Xóa vĩnh viễn",
                    'restore' => 'Khôi phục'
                ];
                $users = User::onlyTrashed();
            }
        } else {
            $users = User::where('name', 'like', '%' . $request->keyword . '%');
        }
        $users = $users->paginate(10);
        $num_all = User::count();
        $num_active = User::where('status', User::STATUS_ACTIVE)->count();
        $num_pending = User::where('status', User::STATUS_PENDING)->count();
        $num_blocked = User::where('status', User::STATUS_BLOCKED)->count();
        $num_trash = User::onlyTrashed()->count();
        return view(
            "admin.user.show",
            compact([
                'users',
                'num_all',
                'num_active',
                'num_pending',
                'num_blocked',
                'num_trash',
                'list_act'
            ])
        );
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'status' => [
                    'required',
                    'in:' . implode(',', [
                        User::STATUS_ACTIVE,
                        User::STATUS_PENDING,
                        User::STATUS_BLOCKED,
                    ])
                ],
                'password' => 'nullable|min:6|confirmed',
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
                'in' => ':attribute không hợp lệ.',
                'string' => ':attribute phải là chuỗi.',
                'min' => ':attribute phải có ít nhất :min ký tự.',
                'confirmed' => ':attribute xác nhận không khớp.',
            ],
            [
                'name' => 'Họ và tên',
                'status' => 'Trạng thái',
                'password' => 'Mật khẩu',
            ]
        );

        $user = User::find($id);

        $user->name = $request->name;
        $user->status = $request->status;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/user')->with('success', 'Cập nhật thông tin người dùng thành công');
    }

    public function destroy($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();

            return redirect('admin/user')->with('success', 'Xóa người dùng thành công.');
        } else {
            return redirect('admin/user')->with('error', 'Bạn không thể tự xóa chính mình ra khỏi hệ thống.');
        }
    }

    public function action(Request $request)
    {
        $action = $request->action;
        $list_check = $request->list_check;

        if (!empty($list_check)) {
            if ($action == 'active') {
                User::whereIn('id', $list_check)
                    ->update(['status' => User::STATUS_ACTIVE]);
                return redirect('admin/user')->with('success', 'Bạn đã cập nhật đang hoạt động thành công!');
            } elseif ($action == 'pending') {
                User::whereIn('id', $list_check)
                    ->update(['status' => User::STATUS_PENDING]);
                return redirect('admin/user')->with('success', 'Bạn đã cập nhật chờ duyệt thành công!');
            } elseif ($action == 'blocked') {
                User::whereIn('id', $list_check)
                    ->update(['status' => User::STATUS_BLOCKED]);
                return redirect('admin/user')->with('success', 'Bạn đã cập nhật bị khóa thành công!');
            } elseif ($action == 'delete') {
                User::destroy($list_check);
                return redirect('admin/user')->with('success', 'Bạn đã xóa thành công!');
            } elseif ($action == 'restore') {
                User::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect('admin/user')->with('success', 'Bạn đã khôi phục thành công!');
            } elseif ($action == 'permanentlyDelete') {
                User::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect('admin/user')->with('success', 'Bạn đã xóa vĩnh viễn thành công!');
            }
        }
        return redirect('admin/user');
    }
}
