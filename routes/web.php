<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\FaqManageController  as AdminFaqController;
use App\Http\Controllers\Admin\SubscriberController;


//== Guest Route ==
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// == Subscribe and Unsubscribe Route ==
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

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
    Route::resource('faqs', AdminFaqController::class)->except(['show']);
    Route::get('subscribers/export', [SubscriberController::class, 'export'])->name('subscribers.export');
    Route::resource('subscribers', SubscriberController::class)->only(['index', 'destroy']);
});

//== Logout Route == 
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])
    ->middleware('admin.auth')
    ->name('admin.logout');