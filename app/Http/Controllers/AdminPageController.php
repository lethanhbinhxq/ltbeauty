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
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'public') {
                $list_act['pending'] = 'Chờ duyệt';
                $pages = Page::where('status', 'public');
            } elseif ($request->status == 'pending') {
                $list_act['public'] = 'Công khai';
                $pages = Page::where('status', 'pending');
            } else {
                $list_act = [
                    'permanentlyDelete' => "Xóa vĩnh viễn",
                    'restore' => 'Khôi phục'
                ];
                $pages = Page::onlyTrashed();
            }
        } else {
            $pages = Page::where('title', 'like', '%' . $request->keyword . '%');
        }
        $pages = $pages->paginate(10);
        $num_all = Page::count();
        $num_public = Page::where('status', Page::STATUS_PUBLIC)->count();
        $num_pending = Page::where('status', Page::STATUS_PENDING)->count();
        $num_trash = Page::onlyTrashed()->count();
        return view("admin.page.show", compact([
            'pages',
            'num_public',
            'num_pending',
            'num_all',
            'num_trash',
            'list_act'
        ]));
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

        return redirect('admin/page')->with('success', 'Thêm trang thành công');
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

    public function action(Request $request)
    {
        $action = $request->action;
        $list_check = $request->list_check;

        if (!empty($list_check)) {
            if ($action == 'public') {
                Page::whereIn('id', $list_check)
                    ->update(['status' => Page::STATUS_PUBLIC]);
                return redirect('admin/page')->with('success', 'Bạn đã cập nhật công khai thành công!');
            } elseif ($action == 'pending') {
                Page::whereIn('id', $list_check)
                    ->update(['status' => Page::STATUS_PENDING]);
                return redirect('admin/page')->with('success', 'Bạn đã cập nhật chờ duyệt thành công!');
            } elseif ($action == 'delete') {
                Page::destroy($list_check);
                return redirect('admin/page')->with('success', 'Bạn đã xóa thành công!');
            } elseif ($action == 'restore') {
                Page::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect('admin/page')->with('success', 'Bạn đã khôi phục thành công!');
            } elseif ($action == 'permanentlyDelete') {
                Page::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect('admin/page')->with('success', 'Bạn đã xóa vĩnh viễn thành công!');
            }
        }
        return redirect('admin/page');
    }
}
