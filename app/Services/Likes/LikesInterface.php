<?php

namespace App\Services\Likes;

interface LikesInterface
{
    public function storeLikeService($product_id);
    public function storeDislikeService($product_id);
}
