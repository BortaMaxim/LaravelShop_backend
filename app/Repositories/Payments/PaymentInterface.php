<?php

namespace App\Repositories\Payments;

interface PaymentInterface
{
    public function pay($request);
}
