<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        return Product::get();
    }

    public function productGetOne($id)
    {
        return Product::findOrFail($id);
    }
}
