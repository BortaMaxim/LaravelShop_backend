<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\EmailVerification\EmailVerificationInterface;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

/**
 * @property EmailVerificationInterface $emailVerification
 */
class VerificationController extends Controller
{
    public function __construct(EmailVerificationInterface $emailVerification)
    {
        $this->emailVerification = $emailVerification;
    }

    public function resend(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['success' => true, 'message' => 'resend']);
    }

    public function verify(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return $this->emailVerification->emailVerify($request);
    }
}
