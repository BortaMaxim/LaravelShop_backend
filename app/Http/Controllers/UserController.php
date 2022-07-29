<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreLoginRequest;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use App\Repositories\User\UserInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property UserInterface $user
 */
class UserController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
        $this->user = $user;
    }

    public function register(StoreRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->user->register($request);
    }

    public function login(StoreLoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->user->login($request);
    }

    public function userInfo(): \Illuminate\Http\JsonResponse
    {
        return $this->user->profileInfo();
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        return $this->user->logout();
    }

    public function updateProfile(UpdateProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->user->updateProfile($request);
    }
}
