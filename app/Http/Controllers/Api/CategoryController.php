<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return Category::parents()
            ->select('id', 'name', 'parent_id')
            ->with(['childrens' => function ($query) {
                $query->select('id', 'name', 'parent_id')->has('products');
            }])
            ->has('products')
            ->orWhereHas('childrens', function ($query) {
                $query->has('products');
            })
            ->get();
    }
}
