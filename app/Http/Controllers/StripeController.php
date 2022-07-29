<?php

namespace App\Http\Controllers;

use App\Repositories\Stripe\StripePaymentInterface;
use Illuminate\Http\Request;
use Stripe\StripeClient;

/**
 * @property StripePaymentInterface $stripePayment
 */
class StripeController extends Controller
{
    public function __construct(StripePaymentInterface $stripePayment)
    {
        $this->stripePayment = $stripePayment;
    }

    public function stripe()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        return $stripe->paymentIntents->all(['limit' => 1]);
    }

    public function stripePost(Request $request)
    {
        return $this->stripePayment->stripePayment($request);
    }
}
