<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;
use App\Http\Resources\ProductResourceManagement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductsManagementController extends Controller
{
    protected $products;
    public function __construct()
    {
        $this->middleware("auth:api");
        $this->products = new Product();
    }

    public function getAllProducts()
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            return ProductResourceManagement::collection($this->products->all());
        }else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Manager or Admin!'
            ]);
        }
    }

    public function getOneProduct($id)
    {
        $product = $this->products->find($id);
        return $product;
    }

    public function createProduct(StoreProductsRequest $request)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $request->validated();
            if ($product_image = $request->file('product_img')) {
                $product_image_name = $request->product_img->getClientOriginalName();
                $product_image->move('products/', $product_image_name);
            }

            $this->products->title = $request->title;
            $this->products->description = $request->description;
            $this->products->price = $request->price;
            $this->products->product_img = $product_image_name;
            $this->products->category_id = $request->category_id;

            $this->products->save();
            return response()->json([
                'success' => true,
                'message' => 'Product created!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Manager or Admin!'
            ]);
        }
    }

    public function updateProduct(UpdateProductsRequest $request, $id)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $product = $this->products->find($id);
            $request->validated();
            if ($product_image = $request->file('product_img')) {
                $product_img_name = $request->product_img->getClientOriginalName();
                $product_image->move('products/', $product_img_name);
            }
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_img = $product_img_name;
            $product->category_id = $request->category_id;

            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product updated!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Manager or Admin!'
            ]);
        }
    }

    public function deleteProduct($id)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $product = $this->products->findOrFail($id);
            $product->destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Product deleted!'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Manager or Admin!'
            ]);
        }
    }
}
