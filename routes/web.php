<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');

    Route::get('admin/order', [OrderController::class, 'show'])->name('admin.order');

    Route::get('admin/page', [PageController::class, 'show'])->name('admin.page');
    Route::get('admin/page/add', [PageController::class, 'add'])->name('admin.page.add');

    Route::get('admin/role/permission', [PermissionController::class, 'permission']);
    Route::get('admin/role', [PermissionController::class, 'showRole']);
    Route::get('admin/role/add', [PermissionController::class, 'addRole']);

    Route::get('admin/post', [PostController::class, 'show']);
    Route::get('admin/post/add', [PostController::class, 'add']);
    Route::get('admin/post/cat', [PostController::class, 'cat']);

    Route::get('admin/product', [ProductController::class, 'show']);
    Route::get('admin/product/add', [ProductController::class, 'add']);
    Route::get('admin/product/cat', [ProductController::class, 'cat']);

    Route::get('admin/user', [UserController::class, 'show']);
    Route::get('admin/user/add', [UserController::class, 'add']);
    Route::post('admin/user/insert', [UserController::class, 'insert']);
    Route::post('admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });
})->middleware(['auth', 'verified']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__ . '/auth.php';
