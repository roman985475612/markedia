<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;

Route::get('/'               , [BlogController::class, 'index'])->name('home');
Route::get('/article/{slug}' , [BlogController::class, 'show'])->name('article');
Route::get('/category/{slug}', [BlogController::class, 'listByCategory'])->name('category');
Route::get('/tag/{slug}'     , [BlogController::class, 'listByTag'])->name('tag');

Route::middleware(['guest'])->group(function() {
    Route::get('/register' , [UserController::class, 'create'])->name('user.create');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');
    Route::get('/login'    , [UserController::class, 'login'])->name('login');
    Route::post('/login'   , [UserController::class, 'loginStore'])->name('login_store');    
});

Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin',
], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/posts', PostController::class);
    Route::get('/categories/list', [CategoryController::class, 'list']);
    Route::resource('/categories', CategoryController::class);
    Route::get('/tags/list', [TagController::class, 'list']);
    Route::resource('/tags', TagController::class);
});