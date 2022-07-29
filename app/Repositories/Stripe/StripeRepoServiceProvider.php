<?php

namespace App\Repositories\Stripe;

use Illuminate\Support\ServiceProvider;

class StripeRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(StripePaymentInterface::class, StripePaymentRepository::class);
    }
}
