<?php

namespace App\Services\Likes;

use App\Models\Like;
use App\Models\Product;

class LikeService implements LikesInterface
{
    protected $products;
    protected $likes;
    public function __construct()
    {
        $this->products = new Product();
        $this->likes = new Like();
    }

    public function storeLikeService($product_id): \Illuminate\Http\JsonResponse
    {
        $product = $this->products->findOrFail($product_id);
        $product_likes = $product->likes();
        $isLiked = $this->likes->isLiked($product_id)->first();

        if ($isLiked === null || $isLiked->modified === 0 || $isLiked->likeable_id !== $product->id) {
            $product_likes->create([
                'user_id' => auth()->id(),
                'likeable_id' => $product_id,
                'likes' => true,
                'modified' => true,
            ]);
            $likes_count = $product->likes->where('likes', true)->where('modified', true)->count();
            return response()->json([
                'success' => true,
                'likes' => $likes_count
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'is liked!',
            ]);
        }
    }

    public function storeDislikeService($product_id): \Illuminate\Http\JsonResponse
    {
        $product = $this->products->findOrFail($product_id);
        $product_likes = $product->likes();
        $isDisliked = $this->likes->isDisliked($product_id)->first();

        if ($isDisliked === null || $isDisliked->modified === 0 || $isDisliked->likeable_id !== $product->id) {
            $product_likes->create([
                'user_id' => auth()->id(),
                'likeable_id' => $product_id,
                'dislikes' => false,
                'modified' => true,
            ]);
            $dislikes_count = $product->likes()->where('dislikes', false)
                ->where('likeable_id', $product_id)
                ->where('modified', true)
                ->count();
            return response()->json([
                'success' => true,
                'dislikes' => $dislikes_count
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'is liked!',
            ]);
        }
    }

    public function getLikes($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->products->findOrFail($id);
        $likes = $product->likes()->where('likes', true)->where('likeable_id', $id)->count();
        return response()->json([
            'success' => true,
            'likes' => $likes
        ]);
    }

    public function getDislikes($id): \Illuminate\Http\JsonResponse
    {
        $product = $this->products->findOrFail($id);
        $dislikes = $product->likes()->where('dislikes', false)->where('likeable_id', $id)->count();
        return response()->json([
            'success' => true,
            'dislikes' => $dislikes
        ]);
    }
}
