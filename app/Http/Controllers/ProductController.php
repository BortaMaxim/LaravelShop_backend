<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

/**
 * @property ProductInterface $product
 */
class ProductController extends Controller
{
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function getAllProducts(): \Illuminate\Http\JsonResponse
    {
        $cached_products = Cache::store('redis')->get('products');

        if(isset($cached_products)) {
            $products = json_decode($cached_products);
            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $products,
            ]);
        }else {
            $products = Product::all();
            Cache::store('redis')->put('products', $products);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $products,
            ]);
        }

    }

    public function getProductsLimit($limit)
    {
        return $this->product->getProductsLimit($limit);
    }

    public function productGetOne($id): ProductResource
    {
        return $this->product->productGetOne($id);
    }

    public function filterProducts(Request $request)
    {
       return $this->product->productsFilter($request);
    }

}
