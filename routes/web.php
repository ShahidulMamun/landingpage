<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;

Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');