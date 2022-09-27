<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', Home::class);
Route::get('shop', Shop::class)->name('shop');
Route::get('products', Products::class)->name('products');
Route::get('incomes', Incomes::class)->name('incomes');
