<?php

namespace App\Repositories\Admin\UserManagement;

interface UserManagementInterface
{
    public function createUser($request);
    public function getUsers();
    public function getOneUser(int $user_id);
    public function updateUser($request, int $user_id);
    public function deleteUser(int $user_id);
}
