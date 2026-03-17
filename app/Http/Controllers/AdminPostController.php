<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostCat;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    //
    public function add() {
        return view('admin.post.add');
    }

    public function show() {
        return view('admin.post.show');
    }

    public function cat() {
        $cats = PostCat::all();
        return view('admin.post.cat', compact('cats'));
    }

    public function addCat(Request $request) {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'status' => 'required|in:' . PostCat::STATUS_PENDING . ',' . PostCat::STATUS_PUBLIC,
            ],
            [
                'required' => ':attribute không được để trống.',
                'string' => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :min ký tự.',
                'in' => ':attribute không hợp lệ.',
            ],
            [
                'name' => 'Tên danh mục',
                'status' => 'Trạng thái',
            ]
        );

        PostCat::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect('admin/post/cat')->with('success', 'Thêm danh mục bài viết thành công');
    }
}
