<?php

namespace App\Services\User\CreateUser;

use App\Entities\UserEntity;

interface CreateUserServiceInterface
{
    public function create(UserEntity $userEntity): UserEntity;
}
