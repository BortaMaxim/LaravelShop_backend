<?php

namespace App\Contracts\Like;

interface LikeableRelationsWithQueries
{
    public function likeable();
    public function isLiked(int $product_id);
    public function isDisliked(int $product_id);
}
