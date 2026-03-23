<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    //
    public function add()
    {
        $post_cats = PostCat::all();
        return view('admin.post.add', compact('post_cats'));
    }

    public function insert(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'detail' => 'required',
                'cat_id' => 'integer|exists:post_cats,id',
                'status' => 'required|in:' . Post::STATUS_PENDING . ',' . Post::STATUS_PUBLIC,
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

        $thumbnail = "";
        if ($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;
            // Lấy tên file
            $filename = $file->getClientOriginalName();

            $file->move('uploads', $filename);
            $thumbnail = 'uploads/' . $filename;
        }

        Post::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'slug' => Str::slug($request->title),
            'thumbnail' => $thumbnail,
            'cat_id' => $request->cat_id,
            'status' => $request->status,
        ]);

        return redirect('admin/post')->with('success', 'Thêm bài viết thành công');
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'detail' => 'required',
                'cat_id' => 'nullable|integer|exists:post_cats,id',
                'status' => 'required|in:' . Post::STATUS_PENDING . ',' . Post::STATUS_PUBLIC,
                'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            ],
            [
                'required' => ':attribute không được để trống.',
                'string' => ':attribute phải là chuỗi.',
                'max' => ':attribute có tối đa :max ký tự.',
                'integer' => ':attribute phải là số.',
                'exists' => ':attribute không tồn tại.',
                'in' => ':attribute không hợp lệ.',
                'image' => ':attribute phải là tệp hình ảnh.',
                'mimes' => ':attribute phải có định dạng: :values.',
            ],
            [
                'title' => 'Tiêu đề',
                'detail' => 'Nội dung',
                'cat_id' => 'Danh mục',
                'status' => 'Trạng thái',
                'thumbnail' => 'Ảnh đại diện',
            ]
        );

        $post = Post::find($id);

        $thumbnail = $post->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $file->move('uploads/posts', $filename);
            $thumbnail = 'uploads/posts/' . $filename;
        }

        $post->update([
            'title' => $request->title,
            'detail' => $request->detail,
            'thumbnail' => $thumbnail,
            'cat_id' => $request->cat_id,
            'status' => $request->status,
        ]);

        return redirect('admin/post')->with('success', 'Cập nhật bài viết thành công');
    }

    public function show(Request $request)
    {
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($request->status && $request->status != 'all') {
            if ($request->status == 'public') {
                $list_act['pending'] = 'Chờ duyệt';
                $posts = Post::where('status', 'public');
            } elseif ($request->status == 'pending') {
                $list_act['public'] = 'Công khai';
                $posts = Post::where('status', 'pending');
            } else {
                $list_act = [
                    'permanentlyDelete' => "Xóa vĩnh viễn",
                    'restore' => 'Khôi phục'
                ];
                $posts = Post::onlyTrashed();
            }
        } else {
            $posts = Post::where('title', 'like', '%' . $request->keyword . '%');
        }
        $posts = $posts->paginate(10);
        $num_all = Post::count();
        $num_public = Post::where('status', Post::STATUS_PUBLIC)->count();
        $num_pending = Post::where('status', Post::STATUS_PENDING)->count();
        $num_trash = Post::onlyTrashed()->count();
        return view("admin.post.show", compact([
            'posts',
            'num_public',
            'num_pending',
            'num_all',
            'num_trash',
            'list_act'
        ]));
    }

    public function edit($id)
    {
        $post_cats = PostCat::all();
        $post = Post::find($id);
        return view('admin.post.edit', compact('post', 'post_cats'));
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('admin/post')->with('success', 'Xóa bài viết thành công.');
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

    public function destroyCat($id)
    {
        $cat = PostCat::find($id);
        $cat->delete();

        return redirect('admin/post/cat')->with('success', 'Xóa danh mục bài viết thành công.');
    }

    public function action(Request $request)
    {
        $action = $request->action;
        $list_check = $request->list_check;

        if (!empty($list_check)) {
            if ($action == 'public') {
                Post::whereIn('id', $list_check)
                    ->update(['status' => Post::STATUS_PUBLIC]);
                return redirect('admin/post')->with('success', 'Bạn đã cập nhật công khai thành công!');
            } elseif ($action == 'pending') {
                Post::whereIn('id', $list_check)
                    ->update(['status' => Post::STATUS_PENDING]);
                return redirect('admin/post')->with('success', 'Bạn đã cập nhật chờ duyệt thành công!');
            } elseif ($action == 'delete') {
                Post::destroy($list_check);
                return redirect('admin/post')->with('success', 'Bạn đã xóa thành công!');
            } elseif ($action == 'restore') {
                Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect('admin/post')->with('success', 'Bạn đã khôi phục thành công!');
            } elseif ($action == 'permanentlyDelete') {
                Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect('admin/post')->with('success', 'Bạn đã xóa vĩnh viễn thành công!');
            }
        }
        return redirect('admin/post');
    }
}
