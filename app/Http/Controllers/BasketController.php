<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redis;

class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addToBasket($id)
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        $redis->set('basket', 'Basket');
        dd($redis->get('basket'));
//        $product = Product::findOrFail($id);
//
//        $basket = session('basket');
//        if (!$basket) {
//            $basket[$id] = [
//                'title' => $product->title,
//                'quantity' => 1,
//                'price' => $product->price,
//                'product_img' => $product->product_img,
//            ];
//            session(['basket' => $basket]);
//            return response()->json([
//                'success' => true,
//                'data' => session()->all()
//            ]);
//        }
//
//        if (isset($basket[$id])) {
//            $basket[$id]['quantity']++;
//            session(['basket' => $basket]);
//            return response()->json([
//                'success' => true,
//                'data' => session('basket')
//            ]);
//        }
//        $basket[$id] = [
//            'title' => $product->title,
//            'quantity' => 1,
//            'price' => $product->price,
//            'product_img' => $product->product_img,
//        ];
//        session(['basket' => $basket]);
//        return response()->json([
//            'success' => true,
//            'data' => session('basket')
//        ]);
    }

    public function updateBasket(Request $request)
    {
        if ($request->id && $request->quantity) {
            $basket = session('basket');
            $basket[$request->id]["quantity"] = $request->quantity;
            session(['basket' => $basket]);
            session()->flash('message', 'Cart update successfully !');

            return response()->json([
                'success' => true,
                'data' => session('basket')
            ]);
        }
    }

    public function removeFromBasket(Request $request)
    {
        if ($request->id) {
            $basket = session('basket');
            if (isset($basket[$request->id])) {
                unset($basket[$request->id]);
                session(['basket' => $basket]);
            }
            session()->flash('message', 'Item removed successfully');
            $session = session()->pull('basket', $basket);
            dd($session);
        }
    }
}
