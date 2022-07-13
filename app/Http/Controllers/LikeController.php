<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use App\Services\Likes\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $products;
    protected $likes;
    public function __construct()
    {
        $this->products = new Product();
        $this->likes = new Like();
    }

    public function like($product_id, LikeService $service): \Illuminate\Http\JsonResponse
    {
        return $service->storeLikeService($product_id);
    }

    public function dislike($product_id, LikeService $service): \Illuminate\Http\JsonResponse
    {
        return $service->storeDislikeService($product_id);
    }

    public function getLikes($id, LikeService $service): \Illuminate\Http\JsonResponse
    {
        return $service->getLikes($id);
    }

    public function getDislikes($id, LikeService $service): \Illuminate\Http\JsonResponse
    {
        return $service->getDislikes($id);
    }
}
