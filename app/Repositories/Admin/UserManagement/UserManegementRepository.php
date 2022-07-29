<?php

namespace App\Repositories\Admin\UserManagement;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

/**
 * @property User $user
 */
class UserManegementRepository implements UserManagementInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsers()
    {
        return $this->user->where('id', '!=', auth()->id())->get();
    }

    public function getOneUser(int $user_id)
    {
        return $this->user->find($user_id);
    }

    public function createUser($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        if ($avatar = $request->file('avatar')) {
            $avatar_name = $request->avatar->getClientOriginalName();
            $avatar->move('avatars/', $avatar_name);
        }

        $user = $this->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $avatar_name;
        $user->roles = $request->roles;
        $user->password = Hash::make($request->password);

        $user->save();
        event(new Registered($user));

        return response()->json([
            'success' => true,
            'message' => 'User created!',
        ]);
    }

    public function updateUser($request, int $user_id): \Illuminate\Http\JsonResponse
    {
        $foundet_user = $this->user->findOrFail($user_id);

        $request->validated();

        if ($avatar = $request->file('avatar')) {
            $avatar_name = $request->avatar->getClientOriginalName();
            $avatar->move('avatars/', $avatar_name);
        }

        $foundet_user->name = $request->name;
        $foundet_user->email = $request->email;
        $foundet_user->avatar = $avatar_name;
        $foundet_user->roles = $request->roles;
        $foundet_user->password = Hash::make($request->password);

        $foundet_user->save();
        return response()->json([
            'success' => true,
            'message' => 'User updated!',
        ]);
    }

    public function deleteUser(int $user_id): \Illuminate\Http\JsonResponse
    {
        $foundet_user = $this->user->findOrFail($user_id);
        $foundet_user->destroy($user_id);

        return response()->json([
            'success' => true,
            'message' => 'User deleted!'
        ]);
    }
}
