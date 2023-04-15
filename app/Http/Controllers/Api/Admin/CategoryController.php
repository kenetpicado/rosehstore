<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::parents()
            ->select('id', 'name', 'parent_id')
            ->with(['childrens' => function ($query) {
                $query->select('id', 'name', 'parent_id');
            }])
            ->get();
    }

    public function store(Request $request)
    {
        Category::create($request->all());

        return response()->noContent();
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->noContent();
    }
}
