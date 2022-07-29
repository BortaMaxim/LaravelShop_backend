<?php

namespace App\Repositories\Like;

use Illuminate\Support\ServiceProvider;

class LikeDislikeRepoService extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LikeDislikeInterface::class, LikeDislikeRepository::class);
    }
}
