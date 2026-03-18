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
}
