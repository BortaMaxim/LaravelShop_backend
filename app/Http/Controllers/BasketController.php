<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart');
        if (!$cart) {
            $cart[$id] = [
                'title' => $product->title,
                'quantity' => 1,
                'price' => $product->price,
                'product_img' => $product->product_img,
            ];
            session('cart', $cart);
            return response()->json([
                'success' => true,
                'data' => $cart[$id]
            ]);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session('cart', $cart);
            return response()->json([
                'success' => true,
                'data' => $cart[$id]
            ]);
        }
        $cart[$id] = [
            'title' => $product->title,
            'quantity' => 1,
            'price' => $product->price,
            'product_img' => $product->product_img,
        ];
        session('cart', $cart);
        return response()->json([
            'success' => true,
            'data' => $cart[$id]
        ]);
    }
}
