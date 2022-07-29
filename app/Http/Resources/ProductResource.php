<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\ProductGallery;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = Category::find($this->category_id);
        $product_galleries = ProductGalleryResource::collection(ProductGallery::where('product_id', $this->id)->get());
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'product_img' => $this->product_img,
            'category_id' => $category->name,
            'created_at' => $this->created_at,
            'product_gallery' => $product_galleries
        ];
    }
}
