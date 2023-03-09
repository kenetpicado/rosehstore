<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __invoke()
    {
        return ProductResource::collection(
            Product::query()
                ->where('status', true)
                ->select(
                    'id',
                    'SKU',
                    'description',
                    'default_price',
                    'image',
                    'category_id',
                    'created_at',
                )
                ->hasStock()
                ->with(['stocks' => function ($query) {
                    $query->select('id', 'current_quantity', 'size', 'price', 'product_id', 'created_at')
                        ->where('current_quantity', '>', 0);
                }])
                ->with(['category' => function ($query) {
                    $query->select('id', 'name', 'parent_id')->with('parent');
                }])
                ->latest('id')
                ->get()
        );
    }
}
