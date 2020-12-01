<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MainController;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
});