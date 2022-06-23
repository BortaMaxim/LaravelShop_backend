<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function stripe()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        return $stripe->paymentIntents->all(['limit' => 3]);
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $intent = PaymentIntent::create([
            "amount" => $request->amount * 100,
            "currency" => $request->currency,
            "receipt_email" => auth()->user()->email,
        ]);

        return response()->json([
            'success' => true,
            'client_secret' => $intent->client_secret
        ]);

    }
}
