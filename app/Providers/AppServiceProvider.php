<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('blog.layouts.layout', function ($view) {
            $view->with('categories'       , Category::getPopular(4));
            $view->with('popularCategories', Category::getPopular());
            $view->with('recentPosts'      , Post::getRecent());
            $view->with('popularPosts'     , Post::getPopular());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
