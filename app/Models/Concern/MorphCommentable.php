<?php

namespace App\Models\Concern;

trait MorphCommentable
{
    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
