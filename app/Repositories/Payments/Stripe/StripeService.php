<?php

namespace App\Repositories\Payments\Stripe;

use App\Repositories\Payments\PaymentInterface;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeService implements PaymentInterface
{
    /**
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function pay($request): \Illuminate\Http\JsonResponse
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
