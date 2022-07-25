<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    public function resend(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['success' => true, 'message' => 'resend']);
    }

    public function verify(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
