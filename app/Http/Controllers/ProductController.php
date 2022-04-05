<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts($limit)
    {
        $products = new Product();
        return $products->paginate($limit);
    }

    public function productGetOne($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }
}
