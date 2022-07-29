<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function getProductsLimit($limit);
    public function productGetOne($id);
    public function productsFilter($request);
}
