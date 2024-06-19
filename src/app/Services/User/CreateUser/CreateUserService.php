<?php

namespace App\Services\User\CreateUser;

use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Repositories\User\UserRepositoryInterface;
use App\Entities\UserEntity;

class CreateUserService implements CreateUserServiceInterface
{
    private $userEntityFactory;
    private $userRepository;
    public function __construct(UserEntityFactory $userEntityFactory, UserRepositoryInterface $userRepository)
    {
        $this->userEntityFactory = $userEntityFactory;
        $this->userRepository = $userRepository;
    }

    public function create(UserEntity $userEntity): UserEntity
    {
        $user = $this->userRepository->save($userEntity);
        
        return $this->userEntityFactory->createByModel($user);
    }
}
