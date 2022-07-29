<?php

namespace App\Repositories\Comment;

use App\Models\Comment;

class CommentRepository implements CommentInterface
{
    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getComments($product_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $this->comment->getAllComments($product_id);
    }

    public function storeComment($request, $product_id): \Illuminate\Http\JsonResponse
    {
        return $this->comment->storeComment($request, $product_id);
    }
}
