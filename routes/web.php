<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

    Route::get('admin/order', [AdminOrderController::class, 'show'])->name('admin.order')->can('order.view');
    Route::get('admin/order/edit/{id}', [AdminOrderController::class, 'edit'])->name('admin.order.edit')->can('order.edit');
    Route::put('/admin/order/update/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update')->can('order.edit');
    Route::delete('admin/order/delete/{id}', [AdminOrderController::class, 'destroy'])->can('order.delete');
    Route::post('admin/order/action', [AdminOrderController::class, 'action'])->can('order.view');

    Route::get('admin/page', [AdminPageController::class, 'show'])->name('admin.page')->can('page.view');
    Route::get('admin/page/add', [AdminPageController::class, 'add'])->name('admin.page.add')->can('page.add');
    Route::post('admin/page/insert', [AdminPageController::class, 'insert'])->can('page.add');
    Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('admin.page.edit')->can('page.edit');
    Route::post('admin/page/update/{id}', [AdminPageController::class, 'update'])->can('page.edit');
    Route::delete('admin/page/delete/{id}', [AdminPageController::class, 'destroy'])->can('page.delete');
    Route::post('admin/page/action', [AdminPageController::class, 'action'])->can('page.view');

    Route::get('admin/post', [AdminPostController::class, 'show'])->can('post.view');
    Route::get('admin/post/add', [AdminPostController::class, 'add'])->can('post.add');
    Route::post('admin/post/insert', [AdminPostController::class, 'insert'])->can('post.add');
    Route::get('admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin.post.edit')->can('post.edit');
    Route::post('admin/post/update/{id}', [AdminPostController::class, 'update'])->name('admin.post.update')->can('post.edit');
    Route::delete('admin/post/delete/{id}', [AdminPostController::class, 'destroy'])->name('admin.post.delete')->can('post.delete');
    Route::post('admin/post/action', [AdminPostController::class, 'action'])->can('post.view');
    Route::get('admin/post/cat', [AdminPostController::class, 'cat'])->can('post.view');
    Route::post('admin/post/cat/add', [AdminPostController::class, 'addCat'])->can('post.add');
    Route::post('admin/post/cat/edit/{id}', [AdminPostController::class, 'editCat'])->can('post.edit');
    Route::delete('admin/post/cat/delete/{id}', [AdminPostController::class, 'destroyCat'])->can('post.delete');

    Route::get('admin/product', [AdminProductController::class, 'show'])->can('product.view');
    Route::get('admin/product/add', [AdminProductController::class, 'add'])->can('product.add');
    Route::post('admin/product/insert', [AdminProductController::class, 'insert'])->can('product.add');
    Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit')->can('product.edit');
    Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update')->can('product.edit');
    Route::delete('admin/product/delete/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.delete')->can('product.delete');
    Route::post('admin/product/action', [AdminProductController::class, 'action'])->can('product.view');
    Route::get('admin/product/cat', [AdminProductController::class, 'cat'])->can('product.view');
    Route::post('admin/product/cat/add', [AdminProductController::class, 'addCat'])->can('product.add');
    Route::post('admin/product/cat/edit/{id}', [AdminProductController::class, 'editCat'])->can('product.edit');
    Route::delete('admin/product/cat/delete/{id}', [AdminProductController::class, 'destroyCat'])->can('product.delete');

    Route::get('admin/user', [AdminUserController::class, 'show'])->can('user.view');
    Route::get('admin/user/add', [AdminUserController::class, 'add'])->can('user.add');
    Route::post('admin/user/insert', [AdminUserController::class, 'insert'])->can('user.add');
    Route::get('admin/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit')->can('user.edit');
    Route::post('admin/user/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update')->can('user.edit');
    Route::delete('admin/user/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy')->can('user.delete');
    Route::post('admin/user/action', [AdminUserController::class, 'action'])->can('user.view');

    Route::get('admin/permission/add', [PermissionController::class, 'add'])->name('permission.add')->can('permission.add');
    Route::post('admin/permission/store', [PermissionController::class, 'store'])->name('permission.store')->can('permission.add');
    Route::get('admin/permission/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->can('permission.edit');
    Route::post('admin/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update')->can('permission.edit');
    Route::delete('admin/permission/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete')->can('permission.delete');

    Route::get('admin/role', [RoleController::class, 'show'])->name('role.show');
    Route::get('admin/role/add', [RoleController::class, 'add'])->name('role.add');
    Route::post('admin/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('admin/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('admin/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('admin/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    Route::group(['prefix' => 'laravel-filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
})->middleware(['auth', 'verified']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

require __DIR__ . '/auth.php';
