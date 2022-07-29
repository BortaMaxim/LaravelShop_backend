<?php

namespace App\Models;

use App\Contracts\Like\LikeableRelationsWithQueries;
use App\Models\Concern\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model implements LikeableRelationsWithQueries
{
    use HasFactory, Likeable;
    protected $guarded = [];

    public function getLikes($product_id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($product_id);
        $likes = $product->likes()->where('likes', true)->where('likeable_id', $product_id)->count();
        return response()->json([
            'success' => true,
            'likes' => $likes
        ]);
    }

    public function getDislikes($product_id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($product_id);
        $dislikes = $product->likes()->where('dislikes', false)->where('likeable_id', $product_id)->count();
        return response()->json([
            'success' => true,
            'dislikes' => $dislikes
        ]);
    }

    public function storeLike($product_id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($product_id);
        $product_likes = $product->likes();
        $isLiked = static::isLiked($product_id)->first();

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

    public function storeDislike($product_id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($product_id);
        $product_likes = $product->likes();
        $isDisliked = static::isDisliked($product_id)->first();

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
}
