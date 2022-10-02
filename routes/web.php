<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', Home::class);
Route::get('shop', Shop::class)->name('shop');
Route::get('products', Products::class)->name('products');
Route::get('books', Books::class)->name('books');

Route::get('chuene', function() {
    return DB::table('incomes')->get();
});