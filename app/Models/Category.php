<?php

namespace App\Models;

use App\Contracts\Product\Productable;
use App\Models\Concern\Products;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements Productable
{
    use HasFactory, SoftDeletes, Products;

    protected $guarded = [];

    public function categoriesGet(): \Illuminate\Database\Eloquent\Collection
    {
        return static::all();
    }

    public function getCategory($id): \Illuminate\Http\JsonResponse
    {
        $category = static::findOrFail($id);
        return response()->json([
            'success' => true,
            'name' => $category->name,
            'data' => $category->products
        ]);
    }
}
