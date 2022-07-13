<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Services\Comments\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $product;
    protected $comment;

    public function __construct()
    {
        $this->middleware("auth:api");
        $this->product = new Product();
        $this->comment = new Comment();
    }

    public function storeCommentToProduct(Request $request, $id, CommentService $service): \Illuminate\Http\JsonResponse
    {
        return $service->storeCommentService($request, $id, $this->product);
    }

    public function getCommentOfProduct($id, CommentService $service): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $service->viewCommentService($id, $this->product);
    }
}
