<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;

Route::get('/', function () { return 'Home'; })->name('home');

Route::group([
    'prefix' => 'admin',
], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/posts', PostController::class);
    Route::get('/categories/list', [CategoryController::class, 'list']);
    Route::resource('/categories', CategoryController::class);
    Route::get('/tags/list', [TagController::class, 'list']);
    Route::resource('/tags', TagController::class);
});