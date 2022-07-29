<?php

namespace App\Models\Concern;

use App\Models\ProductGallery;

trait ProductGaleries
{
    public function productGalleries()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
