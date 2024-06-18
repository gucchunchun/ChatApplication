<?php

namespace App\Services\GetUserEntity;

use App\Entities\UserEntity;

interface GetUserEntityServiceInterface
{
    public function get(string $userId): UserEntity;
}
