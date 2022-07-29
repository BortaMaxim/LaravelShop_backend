<?php

namespace App\Repositories\Like;

use App\Models\Like;

/**
 * @property Like $like
 */
class LikeDislikeRepository implements LikeDislikeInterface
{
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function getLikes(int $product_id): \Illuminate\Http\JsonResponse
    {
        return $this->like->getLikes($product_id);
    }

    public function getDislikes(int $product_id): \Illuminate\Http\JsonResponse
    {
        return $this->like->getDislikes($product_id);
    }

    public function storeLike(int $product_id): \Illuminate\Http\JsonResponse
    {
        return $this->like->storeLike($product_id);
    }
    public function storeDislike(int $product_id): \Illuminate\Http\JsonResponse
    {
        return $this->like->storeDislike($product_id);
    }
}
