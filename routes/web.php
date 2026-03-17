<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;

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

    Route::get('/admin', [AdminDashboardController::class, 'dashboard'])->name('admin');

    Route::get('admin/order', [AdminOrderController::class, 'show'])->name('admin.order');

    Route::get('admin/page', [AdminPageController::class, 'show'])->name('admin.page');
    Route::get('admin/page/add', [AdminPageController::class, 'add'])->name('admin.page.add');
    Route::post('admin/page/insert', [AdminPageController::class, 'insert']);
    Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('admin.page.edit');
    Route::post('admin/page/update/{id}', [AdminPageController::class, 'update']);
    Route::delete('admin/page/delete/{id}', [AdminPageController::class, 'destroy']);

    Route::get('admin/role/permission', [AdminRoleController::class, 'permission']);
    Route::get('admin/role', [AdminRoleController::class, 'showRole']);
    Route::get('admin/role/add', [AdminRoleController::class, 'addRole']);

    Route::get('admin/post', [AdminPostController::class, 'show']);
    Route::get('admin/post/add', [AdminPostController::class, 'add']);
    Route::get('admin/post/cat', [AdminPostController::class, 'cat']);
    Route::post('admin/post/cat/add', [AdminPostController::class, 'addCat']);
    Route::post('admin/post/cat/edit/{id}', [AdminPostController::class, 'editCat']);
    Route::delete('admin/post/cat/delete/{id}', [AdminPostController::class, 'destroy']);

    Route::get('admin/product', [AdminProductController::class, 'show']);
    Route::get('admin/product/add', [AdminProductController::class, 'add']);
    Route::get('admin/product/cat', [AdminProductController::class, 'cat']);

    Route::get('admin/user', [AdminUserController::class, 'show']);
    Route::get('admin/user/add', [AdminUserController::class, 'add']);
    Route::post('admin/user/insert', [AdminUserController::class, 'insert']);
    Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');

    Route::group(['prefix' => 'laravel-filemanager'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });
})->middleware(['auth', 'verified']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__ . '/auth.php';
