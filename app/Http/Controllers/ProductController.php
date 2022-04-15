<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class ProductController extends Controller
{
    public function getProductsLimit($limit)
    {
        $products = new Product();
        return $products->paginate($limit);
    }

    public function productGetOne($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function filterProducts(Request $request)
    {
        $product = new Product();
        if ($request->has('title')) {
            return $product->where('title', 'LIKE', '%' . $request->title . '%')->get();
        }

        return $product;
    }
}