<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function likeable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function isLiked($product_id)
    {
        return $this->where('user_id', auth()->id())->where('likeable_id', $product_id);
    }

    public function isDisliked($product_id)
    {
        return $this->where('user_id', auth()->id())->where('likeable_id', $product_id);
    }
}
