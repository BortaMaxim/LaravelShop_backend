<?php

namespace App\Repositories\Comment;

use Closure;
use Illuminate\Support\ServiceProvider;

class CommentRepoServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CommentInterface::class, CommentRepository::class);
    }
}
