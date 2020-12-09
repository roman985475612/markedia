<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(2);
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::findBySlug($slug);
        $post->increaseViewCount();
        return view('blog.show', compact('post'));
    }
}
