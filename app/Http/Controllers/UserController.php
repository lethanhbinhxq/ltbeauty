<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        if ($request) {
            $users = User::where('name', 'like', '%' . $request->keyword . '%');
        }
        $users = $users->paginate(10);
        $num_active = User::where('status', User::STATUS_ACTIVE)->count();
        $num_pending = User::where('status', User::STATUS_PENDING)->count();
        $num_blocked = User::where('status', User::STATUS_BLOCKED)->count();
        return view(
            "admin.user.show",
            compact('users', 'num_active', 'num_pending', 'num_blocked')
        );
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
            ],
            [
                'required' => ':attribute không được để trống.',
                'max' => ':attribute không được vượt quá :max ký tự.',
                'in' => ':attribute không hợp lệ.',
                'string' => ':attribute phải là chuỗi.',
            ],
            [
                'name' => 'Họ và tên',
                'status' => 'Trạng thái',
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->status = $request->status;

        $user->save();

        return redirect('admin/user')->with('success', 'Cập nhật thông tin người dùng thành công');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('admin/user')->with('success', 'Xóa người dùng thành công.');
    }
}
