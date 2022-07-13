<?php

namespace App\Models\Concern;

use App\Models\Like;

trait Likes
{
    public function likes(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
