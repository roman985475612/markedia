<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\SubsController as AdminSubsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubsController;


Route::get('/'                  , [BlogController::class, 'index'])->name('home');
Route::get('/blog'              , [BlogController::class, 'all'])->name('category.all');
Route::get('/user/{id}/posts'   , [BlogController::class, 'postsByUser'])->name('user.posts');
Route::get('/category/{slug}'   , [BlogController::class, 'category'])->name('category');
Route::get('/article/{slug}'    , [BlogController::class, 'show'])->name('article');
Route::get('/tag/{slug}'        , [BlogController::class, 'tag'])->name('tag');
Route::get('/search'            , [BlogController::class, 'search'])->name('search');
Route::post('/subscribe'        , [SubsController::class, 'subscribe'])->name('subscribe');
Route::get('/verify/{token}'    , [SubsController::class, 'verify'])->name('verify');

Route::middleware(['guest'])->group(function() {
    Route::get('/register'  , [UserController::class, 'create'])->name('user.create');
    Route::post('/register' , [UserController::class, 'store'])->name('user.store');
    Route::get('/login'     , [UserController::class, 'login'])->name('login');
    Route::post('/login'    , [UserController::class, 'loginStore'])->name('login_store');    
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/article/add-comment', [CommentController::class, 'store'])->name('article.add_comment');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/posts'        , PostController::class);
    Route::get('/categories/list'   , [CategoryController::class, 'list']);
    Route::resource('/categories'   , CategoryController::class);
    Route::get('/tags/list'         , [TagController::class, 'list']);
    Route::resource('/tags'         , TagController::class);
    Route::resource('/subs'         , AdminSubsController::class);
    Route::get('/verify/{token}'    , [SubsController::class, 'verify'])->name('subs.verify');
});