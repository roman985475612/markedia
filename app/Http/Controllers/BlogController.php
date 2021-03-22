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
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(10);
        $title = 'Home';

        return view('blog.index', compact(
            'posts',
            'title'
        ));
    }

    public function all()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(10);
        $title = $category_title = 'Blog';

        $breadcrumbs = [
            ['Blog'],
        ];
        
        return view('blog.index', compact(
            'posts',
            'title',
            'category_title',
            'breadcrumbs'
        ));
    }

    public function show($slug)
    {
        $post = Post::findBySlug($slug);
        $post->increaseViewCount();

        $prevPost = Post::find($post->hasPrev());
        $nextPost = Post::find($post->hasNext());

        $title = $small_title = $post->title;
        $category_title = $post->category->title;
        $category_slug = $post->category->slug;

        $breadcrumbs = [
            ['Blog', route('category.all')],
            [$category_title],
        ];

        return view('blog.show', compact(
            'post',
            'prevPost',
            'nextPost',
            'title', 
            'small_title',
            'category_title',
            'category_slug',
            'breadcrumbs'
        ));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(2);
        $title = $category_title = $category->title;

        $breadcrumbs = [
            ['Blog', route('category.all')],
            [$category_title],
        ];
        
        return view('blog.index', compact(
            'title',
            'posts',
            'category_title',
            'breadcrumbs'
        ));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->with('category')->paginate(10);
        $title = $category_title = $tag->title;

        $breadcrumbs = [
            ['Blog', route('category.all')],
            [$category_title],
        ];

        return view('blog.index', compact(
            'title',
            'category_title',
            'posts',
            'breadcrumbs'
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

        $breadcrumbs = [
            ['Blog', route('category.all')],
            [$category_title],
        ];

        return view('blog.index', compact(
            'posts',
            'title',
            'category_title',
            'breadcrumbs',
        ));
    }
}
