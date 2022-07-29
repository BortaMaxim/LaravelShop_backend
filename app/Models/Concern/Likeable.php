<?php

namespace App\Models\Concern;

use App\Models\Like;

trait Likeable
{
    public function likeable()
    {
        return $this->morphTo();
    }

    public function isLiked($product_id)
    {
        return Like::where('user_id', auth()->id())->where('likeable_id', $product_id);
    }

    public function isDisliked($product_id)
    {
        return Like::where('user_id', auth()->id())->where('likeable_id', $product_id);
    }
}
