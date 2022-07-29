<?php

namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @property User $user
 */
class UserRepository extends Controller implements UserInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = $this->user->create($data);
        event(new Registered($user));

        return response()->json([
            'success' => true,
            'message' => 'Register Successfully!  Please confirm your email on '. " http://localhost:8025/",
        ], 200);
    }

    public function login($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        $credentials = $request->only('email', 'password');
        $user = $this->user->where('email', $credentials['email'])->first();
        if ($user) {
            if (!auth()->attempt($credentials)) {
                $responseMessage = "Invalid username or password";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            $accessToken = auth()->user()->createToken('accessToken')->accessToken;
            $responseMessage = "Login Successful";

            return $this->respondWithToken($accessToken, $responseMessage, auth()->user());
        }else {
            $responseMessage = "Sorry, this user does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function profileInfo(): \Illuminate\Http\JsonResponse
    {
        $data = auth()->guard('api')->user();
        return response()->json([
            'success' => true,
            'message' => "Hello  $data->name !!!",
            'data' => $data
        ]);
    }

    public function updateProfile($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();

        if ($avatar = $request->file('avatar')) {
            $avatar_name = $request->avatar->getClientOriginalName();
            $avatar->move('avatars/', $avatar_name);
        }

        $userProfile = Auth::user();
        $userProfile->email = $request->email;
        $userProfile->name = $request->name;
        $userProfile->password = Hash::make($request->password);
        $userProfile->avatar = $avatar_name;
        $userProfile->save();

        return response()->json([
            'update_success' => true,
            'message' => 'updated success',
            'data' => $userProfile
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('api')->user()->token();
        $user->revoke();
        $responseMessage = "Successfully logged out ";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }
}
