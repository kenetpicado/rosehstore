<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function () {
    Route::get('/', Home::class)->name('home');

    Route::get('categories', Categories::class)->name('categories');

    Route::get('muebles-y-decoracion', Fornitures::class)->name('fornitures');

    Route::get('users', Users::class)->name('users');

    Route::get('products', Products::class)->name('products');

    Route::get('stock/{product}', Stocks::class)->name('stock');

    Route::get('shop', Shop::class)->name('shop');
    Route::get('books', Books::class)->name('books');
});

Auth::routes();
