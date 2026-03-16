<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function add() {
        return view('admin.page.add');
    }

    public function show() {
        return view("admin.page.show");
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'detail' => 'required',
                'status' => 'required|in:' . Page::STATUS_PENDING . ',' . Page::STATUS_PUBLIC,
            ],
            [
                'required' => ':attribute không được để trống.',
                'string'   => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :min ký tự.',
                'in'       => ':attribute không hợp lệ.',
            ],
            [
                'title' => 'Tiêu đề',
                'detail' => 'Nội dung',
                'status' => 'Trạng thái',
            ]
        );

        Page::create([
            'title'  => $request->title,
            'detail' => $request->detail,
            'status' => $request->status,
        ]);

        return redirect('admin/page')->with('success', 'Thêm bài viết thành công');
    }
}
