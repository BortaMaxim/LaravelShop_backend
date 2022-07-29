<?php

namespace App\Models\Concern;

use App\Models\Category;

trait Categories
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
