<?php

namespace App\Services\GetAuthenticatedUserEntity;

use App\Entities\UserEntity;

interface GetAuthenticatedUserEntityServiceInterface
{
    public function get(): UserEntity;
}
