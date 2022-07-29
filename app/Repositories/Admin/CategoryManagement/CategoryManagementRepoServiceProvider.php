<?php

namespace App\Repositories\Admin\CategoryManagement;

use Illuminate\Support\ServiceProvider;

class CategoryManagementRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryManagementInterface::class, CategoryManagementRepository::class);
    }
}
