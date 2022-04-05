<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return Category::all();
    }

    public function categoriesGetOne($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'success' => true,
            'name' => $category->name,
            'data' => $category->products
        ]);
    }
}
