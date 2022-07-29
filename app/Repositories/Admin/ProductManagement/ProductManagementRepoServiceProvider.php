<?php

namespace App\Repositories\Admin\ProductManagement;

use Illuminate\Support\ServiceProvider;

class ProductManagementRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductManagementInterface::class, ProductManagementRepository::class);
    }
}
