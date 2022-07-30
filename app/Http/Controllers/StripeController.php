<?php

namespace App\Http\Controllers;

use App\Repositories\Payments\PaymentInterface;
use Illuminate\Http\Request;
use Stripe\StripeClient;

/**
 * @property PaymentInterface $stripePayment
 */
class StripeController extends Controller
{
    public function __construct(PaymentInterface $stripePayment)
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
        return $this->stripePayment->pay($request);
    }
}
