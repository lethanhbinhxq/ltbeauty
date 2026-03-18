<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    //
    public function add() {
        return view('admin.product.add');
    }

    public function show() {
        return view('admin.product.show');
    }

    public function cat()
    {
        $cats = ProductCat::all();
        $cats_paginate = ProductCat::paginate(10);
        return view('admin.product.cat', compact('cats', 'cats_paginate'));
    }

    public function addCat(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'status' => 'required|in:' . ProductCat::STATUS_PENDING . ',' . ProductCat::STATUS_PUBLIC,
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

        ProductCat::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect('admin/product/cat')->with('success', 'Thêm danh mục sản phẩm thành công');
    }

    public function editCat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|integer|exists:post_cats,id',
                'status' => 'required|in:' . ProductCat::STATUS_PENDING . ',' . ProductCat::STATUS_PUBLIC,
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

        $cat = ProductCat::find($id);

        $cat->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return redirect('admin/product/cat')->with('success', 'Cập nhật danh mục sản phẩm thành công');
    }

    public function destroyCat($id)
    {
        $cat = ProductCat::find($id);
        $cat->delete();

        return redirect('admin/product/cat')->with('success', 'Xóa danh mục sản phẩm thành công.');
    }
}
