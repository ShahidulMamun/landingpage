<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\OrderManageController;


Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

//== Auth Route == 
Route::middleware('admin.guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store'])->name('login.store');
});

//== Admin Route ==
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderManageController::class)->only(['index', 'show', 'update', 'destroy']);
});

//== Logout Route == 
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])
    ->middleware('admin.auth')
    ->name('admin.logout');