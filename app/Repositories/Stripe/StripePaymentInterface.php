<?php

namespace App\Repositories\Stripe;

interface StripePaymentInterface
{
    public function stripePayment($request);
}
