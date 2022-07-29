<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;

/**
 * @property ProductInterface $product
 */
class ProductController extends Controller
{
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
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
