<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Resources\ProductResourceManagement;
use App\Models\Product;
use App\Repositories\Admin\ProductManagement\ProductManagementInterface;
use Illuminate\Support\Facades\Gate;

/**
 * @property ProductManagementInterface $productManagement
 */
class ProductsManagementController extends Controller
{
    public function __construct(ProductManagementInterface $productManagement)
    {
        $this->middleware("auth:api");
        $this->productManagement = $productManagement;
    }

    public function getAllProducts()
    {
        return $this->productManagement->getProducts();
    }

    public function getOneProduct($id)
    {
        return $this->productManagement->getOneProduct($id);
    }

    public function createProduct(StoreProductsRequest $request)
    {
        return $this->productManagement->createProduct($request);
    }

    public function updateProduct(UpdateProductsRequest $request, $id)
    {
        return $this->productManagement->updateProduct($request, $id);
    }

    public function deleteProduct($id)
    {
        return $this->productManagement->deleteProduct($id);
    }
}
