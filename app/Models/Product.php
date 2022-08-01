<?php

namespace App\Models;

use App\Contracts\Category\Categoreable;
use App\Contracts\Comment\Commentable;
use App\Contracts\Like\Likeable;
use App\Contracts\Product\ProductGallereable;
use App\Http\Resources\ProductResource;
use App\Models\Concern\Categories;
use App\Models\Concern\Comments;
use App\Models\Concern\Likes;
use App\Models\Concern\ProductGaleries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Commentable, Likeable, Categoreable, ProductGallereable
{
    use HasFactory, SoftDeletes, SoftDeletes, Comments, Likes, Categories, ProductGaleries;

    protected $guarded = [];

    public function getProductsLimit($limit)
    {

        return static::paginate($limit);
    }

    public function getOneProduct($id): ProductResource
    {
        return new ProductResource(static::find($id));
    }

     public function filterProducts($request)
     {
         $products = $this;
        if ($request->has('title')) {
            return $products->where('title', 'LIKE', '%' . $request->title . '%')->get();
        }
        return $products;
    }
}
