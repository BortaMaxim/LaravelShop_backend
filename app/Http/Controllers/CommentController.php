<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Repositories\Comment\CommentInterface;
use Illuminate\Http\Request;

/**
 * @property CommentInterface $comment
 */

class CommentController extends Controller
{
    public function __construct(CommentInterface $comment)
    {
        $this->comment = $comment;
    }

    public function storeCommentToProduct(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->comment->storeComment($request, $id);
    }

    public function getCommentOfProduct($id)
    {
        return $this->comment->getComments($id);
    }
}
