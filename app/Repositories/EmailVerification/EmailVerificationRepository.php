<?php

namespace App\Repositories\EmailVerification;

use App\Models\User;
use Illuminate\Auth\Events\Verified;

/**
 * @property User $user
 */
class EmailVerificationRepository implements EmailVerificationInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function emailVerify($request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $user = User::find($request->route('id'));
        $clientUrl = 'http://localhost:3000';

        if ($user->hasVerifiedEmail()) {
            return redirect("$clientUrl/email-already-verified");
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect("$clientUrl/email-verified-success");
    }
}
