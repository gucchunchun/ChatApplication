<?php

namespace App\Services\GetAuthenticatedUserEntity;

use Illuminate\Support\Facades\Auth;

use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Entities\UserEntity;


class GetAuthenticatedUserEntityService implements GetAuthenticatedUserEntityServiceInterface
{
    private $userEntityFactory;
    public function __construct(UserEntityFactory $userEntityFactory)
    {
        $this->userEntityFactory = $userEntityFactory;
    }
    public function get(): UserEntity
    {
        $user = Auth::user();
        return $this->userEntityFactory->createByModel($user);
    }
}
