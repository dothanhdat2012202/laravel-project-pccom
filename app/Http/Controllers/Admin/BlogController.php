<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function create(){
        return view("admin.blog.add", [
            "title" => "Thêm Tin tức mới",
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'thumb' => 'required',
            'active' => 'required'
        ]);

        $blog = new Blog();
        $blog->name = $request->input('name');
        $blog->content = $request->input('content');
        $blog->thumb = $request->input('thumb');
        $blog->active = $request->input('active');
        $blog->save();

        return redirect()->route('blog.create')->with('success', 'Tạo tin tức thành công');
    }
    public function index(){
        $blogs = Blog::all();
        $title = 'Danh sách tin tức';
        return view('admin.blog.list', compact('title','blogs'));
    }
    public function edit(Blog $blog){
        return view('admin.blog.edit', [
            'title' => 'Chỉnh sửa tin tức',
            'blog' => $blog
        ]);
    }

    public function update(Request $request, Blog $blog){
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'thumb' => 'required',
            'active' => 'required'
        ]);

        $blog->name = $request->input('name');
        $blog->content = $request->input('content');
        $blog->thumb = $request->input('thumb');
        $blog->active = $request->input('active');
        $blog->save();

        return redirect()->route('blog.edit', $blog->id)->with('success', 'Cập nhật tin tức thành công');
    }
}
