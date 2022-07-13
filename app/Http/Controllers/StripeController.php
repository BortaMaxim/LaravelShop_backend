<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function stripe()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        return $stripe->paymentIntents->all(['limit' => 1]);
    }

    public function stripePost(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $intent = PaymentIntent::create([
            "amount" => $request->amount * 100,
            "currency" => $request->currency,
        ]);

        return response()->json([
            'success' => true,
            'client_secret' => $intent->client_secret
        ]);

    }
}
