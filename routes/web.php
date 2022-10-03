<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('shop', Shop::class)->name('shop');
Route::get('products', Products::class)->name('products');
Route::get('books', Books::class)->name('books');
Route::get('hires', Hires::class)->name('hires');