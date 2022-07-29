<?php

namespace App\Repositories\Admin\UserManagement;

use Illuminate\Support\ServiceProvider;

class UserManagementRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserManagementInterface::class, UserManegementRepository::class);
    }
}
