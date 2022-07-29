<?php

namespace App\Repositories\Stripe;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentRepository implements StripePaymentInterface
{
    public function stripePayment($request): \Illuminate\Http\JsonResponse
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
