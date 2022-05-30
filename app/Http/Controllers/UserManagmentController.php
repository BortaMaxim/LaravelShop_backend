<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserManagmentController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = new User();
    }

    public function createUsers(StoreUserRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            $request->validated();
            if ($avatar = $request->file('avatar')) {
                $avatar_name = $request->avatar->getClientOriginalName();
                $avatar->move('avatars/', $avatar_name);
            }

            $this->user->name = $request->name;
            $this->user->email = $request->email;
            $this->user->avatar = $avatar_name;
            $this->user->roles = $request->roles;
            $this->user->password = Hash::make($request->password);

            $this->user->save();

            return response()->json([
                'success' => true,
                'message' => 'User created!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Admin!'
            ]);
        }
    }

    public function getUsers()
    {
        if (Gate::allows('isAdmin')) {
            return $this->user->where('id', '!=', auth()->id())->get();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Admin!'
            ]);
        }
    }

    public function getOneUsers($id)
    {
        return $this->user->find($id);
    }

    public function updateUsers(UpdateUsersRequest $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $foundet_user = $this->user->findOrFail($id);

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
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Admin!'
            ]);
        }
    }

    public function deleteUsers($id)
    {
        if (Gate::allows('isAdmin', Auth::user())) {
            $foundet_user = $this->user->findOrFail($id);
            $foundet_user->destroy($id);

            return response()->json([
                'success' => true,
                'message' => 'User deleted!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You are not Admin!'
            ]);
        }
    }
}
