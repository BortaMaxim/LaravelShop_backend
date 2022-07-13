<?php

namespace App\Models\Concern;

use App\Models\Comment;

trait Comments
{
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
