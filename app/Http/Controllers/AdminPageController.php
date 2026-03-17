<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //
    public function add()
    {
        return view('admin.page.add');
    }

    public function show(Request $request)
    {
        if ($request) {
            $pages = Page::where('title', 'like', '%' . $request->keyword . '%');
        }
        $pages = $pages->paginate(10);
        $num_public = Page::where('status', Page::STATUS_PUBLIC)->count();
        $num_pending = Page::where('status', Page::STATUS_PENDING)->count();
        return view("admin.page.show", compact('pages', 'num_public', 'num_pending'));
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
                'string' => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :min ký tự.',
                'in' => ':attribute không hợp lệ.',
            ],
            [
                'title' => 'Tiêu đề',
                'detail' => 'Nội dung',
                'status' => 'Trạng thái',
            ]
        );

        Page::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'status' => $request->status,
        ]);

        return redirect('admin/page')->with('success', 'Thêm bài viết thành công');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'detail' => 'required',
                'status' => 'required|in:' . Page::STATUS_PENDING . ',' . Page::STATUS_PUBLIC,
            ],
            [
                'required' => ':attribute không được để trống.',
                'string' => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :max ký tự.',
                'in' => ':attribute không hợp lệ.',
            ],
            [
                'title' => 'Tiêu đề',
                'detail' => 'Nội dung',
                'status' => 'Trạng thái',
            ]
        );

        $page = Page::find($id);

        $page->update([
            'title' => $request->title,
            'detail' => $request->detail,
            'status' => $request->status,
        ]);

        return redirect('admin/page')->with('success', 'Cập nhật trang thành công');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect('admin/page')->with('success', 'Xóa người dùng thành công.');
    }
}
