<?php

namespace App\Repositories\EmailVerification;

use Illuminate\Support\ServiceProvider;

class EmailVerificationRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EmailVerificationInterface::class, EmailVerificationRepository::class);
    }
}
