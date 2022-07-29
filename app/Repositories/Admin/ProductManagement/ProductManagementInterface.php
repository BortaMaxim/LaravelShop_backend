<?php

namespace App\Repositories\Admin\ProductManagement;

interface ProductManagementInterface
{
    public function getProducts();
    public function getOneProduct(int $product_id);
    public function createProduct($request);
    public function updateProduct($request, int $product_id);
    public function deleteProduct(int $product_id);
}
