<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;
use App\Models\User;
use App\Repositories\Admin\UserManagement\UserManagementInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

/**
 * @property UserManagementInterface $user
 */
class UserManagmentController extends Controller
{

    public function __construct(UserManagementInterface $user)
    {
        $this->middleware("auth:api");
        $this->user = $user;
    }

    public function getUsers()
    {
        return $this->user->getUsers();
    }

    public function getOneUsers($id)
    {
        return $this->user->getOneUser($id);
    }

    public function createUsers(StoreUserRequest $request)
    {
        return $this->user->createUser($request);
    }

    public function updateUsers(UpdateUsersRequest $request, $id)
    {
        return $this->user->updateUser($request, $id);
    }

    public function deleteUsers($id)
    {
        return $this->user->deleteUser($id);
    }
}
