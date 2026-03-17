<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostCat;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    //
    public function add()
    {
        return view('admin.post.add');
    }

    public function show()
    {
        return view('admin.post.show');
    }

    public function cat()
    {
        $cats = PostCat::all();
        $cats_paginate = PostCat::paginate(10);
        return view('admin.post.cat', compact('cats', 'cats_paginate'));
    }

    public function addCat(Request $request)
    {
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

    public function editCat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|integer|exists:post_cats,id',
                'status' => 'required|in:' . PostCat::STATUS_PENDING . ',' . PostCat::STATUS_PUBLIC,
            ],
            [
                'required' => ':attribute không được để trống.',
                'string' => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :max ký tự.',
                'integer' => ':attribute phải là số.',
                'exists' => ':attribute không tồn tại.',
                'in' => ':attribute không hợp lệ.',
            ],
            [
                'name' => 'Tên danh mục',
                'parent_id' => 'Danh mục cha',
                'status' => 'Trạng thái',
            ]
        );

        $cat = PostCat::find($id);

        $cat->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect('admin/post/cat')->with('success', 'Cập nhật danh mục bài viết thành công');
    }
}
