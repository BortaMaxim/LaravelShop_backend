<?php

namespace App\Repositories\EmailVerification;

interface EmailVerificationInterface
{
    public function emailVerify($request);
}
