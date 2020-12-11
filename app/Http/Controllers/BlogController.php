<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(2);
        $title = 'Home';

        return view('blog.index', compact(
            'posts',
            'title'
        ));
    }

    public function show($slug)
    {
        $post = Post::findBySlug($slug);
        $post->increaseViewCount();

        $title = $post->title;
        $category_title = $post->category->title;
        $category_slug = $post->category->slug;

        return view('blog.show', compact(
            'post',
            'title', 
            'category_title',
            'category_slug',
        ));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);
        $title = $category_title = $category->title;
        
        return view('blog.index', compact(
            'title',
            'posts',
            'category_title'
        ));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->paginate(2);
        $title = $category_title = $tag->title;

        return view('blog.index', compact(
            'title',
            'category_title',
            'posts'
        ));
    }

    public function search(Request $request)
    {
        $request->validate([
            's' => 'required'
        ]);

        $posts = Post::findByTitle($request->s);
        $title = "Результаты поиска по запросу {$request->s}";
        $category_title = $request->s;

        return view('blog.index', compact(
            'posts',
            'title',
            'category_title'
        ));
    }
}
