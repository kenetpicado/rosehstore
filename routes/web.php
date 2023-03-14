<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', Home::class)->name('home');

    Route::get('categories', Categories::class)
        ->name('categories');

    Route::get('fornitures', Fornitures::class)
        ->name('fornitures');

    Route::get('rents/{forniture}', Rents::class)
        ->name('rents');

    Route::get('decorations', Decorations::class)
        ->name('decorations');

    Route::get('decorations/create/{decoration?}', DecorationsRegister::class)
        ->name('decorations.register');

    Route::get('users', Users::class)
        ->name('users');

    Route::get('products', Products::class)
        ->name('products');

    Route::get('products/create/{product?}', ProductRegister::class)
        ->name('products.register');

    Route::get('stock/{product}', Stocks::class)
        ->name('stock');

    Route::get('shop', Shop::class)
        ->name('shop');

    Route::get('sales', Sales::class)
        ->name('sales');

    Route::get('rental-income', RentalIncome::class)
        ->name('rental-income');

    Route::get('purchases', Purchases::class)
        ->name('purchases');
});

Auth::routes();
