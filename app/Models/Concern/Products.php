<?php

namespace App\Models\Concern;

use App\Models\Product;

trait Products
{
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
