<?php

namespace App\Http\Controllers;

use App\Repositories\Like\LikeDislikeInterface;

/**
 * @property LikeDislikeInterface $likes
 */
class LikeController extends Controller
{
    public function __construct(LikeDislikeInterface $likes)
    {
        $this->likes = $likes;
    }

    public function like($product_id): \Illuminate\Http\JsonResponse
    {
        return $this->likes->storeLike($product_id);
    }

    public function dislike($product_id): \Illuminate\Http\JsonResponse
    {
        return $this->likes->storeDislike($product_id);
    }

    public function getLikes($id): \Illuminate\Http\JsonResponse
    {
        return $this->likes->getLikes($id);
    }

    public function getDislikes($id)
    {
        return $this->likes->getDislikes($id);
    }
}
