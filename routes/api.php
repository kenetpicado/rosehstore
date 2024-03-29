<?php

use App\Http\Controllers\Api\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//grouping routes by version
Route::prefix('v1')->group(function () {
    Route::get('products', ProductController::class);

    Route::get('categories', CategoryController::class);
});

Route::prefix('admin')->group(function () {
    Route::resource('categories', AdminCategoryController::class);
    Route::get('products-available', [AdminProductController::class, 'available']);
});
