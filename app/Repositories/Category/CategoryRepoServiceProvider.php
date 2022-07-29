<?php

namespace App\Repositories\Category;

use Carbon\Laravel\ServiceProvider;

class CategoryRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }
}
