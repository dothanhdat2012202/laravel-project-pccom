<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('active', 1)->get();
        return view("blog.list", [
            "title" => "Tin tức công nghệ",
            "blogs" => $blogs
        ]);
    }
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.detail', [
            'title' => $blog->name,
            'blog' => $blog,
        ]);
    }
}
