<?php

namespace App\Repositories\Payments;

use App\Http\Controllers\StripeController;
use App\Repositories\Payments\Stripe\StripeService;
use Illuminate\Support\ServiceProvider;

class PaymentRepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(StripeController::class)
            ->needs(PaymentInterface::class)
            ->give(StripeService::class);
    }
}
