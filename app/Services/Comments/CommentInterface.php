<?php

namespace App\Services\Comments;

interface CommentInterface
{
    public function storeCommentService($request, $id, $product);
    public function viewCommentService($id, $product);
}
