<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\User;

class ProductRepository implements ProductInterface
{
    public Product $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductsLimit($limit)
    {
        return $this->product->getProductsLimit($limit);
    }

    public function productGetOne($id): \App\Http\Resources\ProductResource
    {
        return $this->product->getOneProduct($id);
    }

    public function productsFilter($request)
    {
        return $this->product->filterProducts($request);
    }
}
