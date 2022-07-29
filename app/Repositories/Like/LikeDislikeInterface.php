<?php

namespace App\Repositories\Like;

interface LikeDislikeInterface
{
    public function getLikes(int $product_id);
    public function getDislikes(int $product_id);
    public function storeLike(int $product_id);
    public function storeDislike(int $product_id);
}
