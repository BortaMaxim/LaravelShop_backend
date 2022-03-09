<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreLoginRequest;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware("auth:api",["except" => ["login","register"]]);
        $this->user = new User;
    }

    public function register(StoreRegisterRequest $request)
    {
        $request->validated();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $this->user->create($data);
        return response()->json([
            'success' => true,
            'message' => 'Register Successfully !'
        ], 200);
    }

    public function login(StoreLoginRequest $request)
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

    public function userInfo()
    {
        $data = auth()->guard('api')->user();
        return response()->json([
            'success' => true,
            'message' => "Hello  $data->name !!!",
            'data' => $data
        ]);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user()->token();
        $user->revoke();
        $responseMessage = "Successfully logged out ";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }

    public function updateProfile(UpdateProfileRequest $request)
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
            'success' => true,
            'message' => 'updated success',
            'data' => $userProfile
        ]);
    }
}
