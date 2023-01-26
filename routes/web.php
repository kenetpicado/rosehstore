<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/', Home::class)->name('home');

    Route::get('products', Products::class)->name('products');

    Route::get('categories', Categories::class)->name('categories');

    Route::get('shop', Shop::class)->name('shop');
    Route::get('books', Books::class)->name('books');
    Route::get('hires', Hires::class)->name('hires');
});

Auth::routes();
