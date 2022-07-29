<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function register($request);
    public function login($request);
    public function profileInfo();
    public function updateProfile($request);
    public function logout();
}
