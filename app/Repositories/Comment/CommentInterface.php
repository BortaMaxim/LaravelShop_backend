<?php

namespace App\Repositories\Comment;

interface CommentInterface
{
    public function getComments($product_id);
    public function storeComment($request, $product_id);
}
