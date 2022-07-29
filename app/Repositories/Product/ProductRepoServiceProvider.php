<?php

namespace App\Repositories\Product;

use Illuminate\Support\ServiceProvider;

class ProductRepoServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }
}
