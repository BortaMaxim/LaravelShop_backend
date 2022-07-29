<?php

namespace App\Repositories\Admin\ProductManagement;

use App\Http\Resources\ProductResourceManagement;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

/**
 * @property Product $product
 */
class ProductManagementRepository implements ProductManagementInterface
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProducts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductResourceManagement::collection($this->product->all());
    }

    public function getOneProduct(int $product_id)
    {
        return $this->product->find($product_id);
    }

    public function createProduct($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        if ($product_image = $request->file('product_img')) {
            $product_image_name = $request->product_img->getClientOriginalName();
            $product_image->move('products/', $product_image_name);
        }

        $this->product->title = $request->title;
        $this->product->description = $request->description;
        $this->product->price = $request->price;
        $this->product->product_img = $product_image_name;
        $this->product->category_id = $request->category_id;

        $this->product->save();
        return response()->json([
            'success' => true,
            'message' => 'Product created!'
        ]);
    }

    public function updateProduct($request, int $product_id): \Illuminate\Http\JsonResponse
    {
        $product = $this->product->find($product_id);
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
    }

    public function deleteProduct(int $product_id): \Illuminate\Http\JsonResponse
    {
        $product = $this->product->findOrFail($product_id);
        $product->destroy($product_id);
        return response()->json([
            'success' => true,
            'message' => 'Product deleted!'
        ]);
    }
}
