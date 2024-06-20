<?php

namespace App\UseCases;

use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Entities\UserEntity;
use App\DTO\UserData;

class RegisterUseCase
{
    private $createUserService;
    private $userEntityFactory;

    public function __construct(CreateUserServiceInterface $createUserService, UserEntityFactory $userEntityFactory)
    {
        $this->createUserService = $createUserService;
        $this->userEntityFactory = $userEntityFactory;
    }

    public function execute(array $data): UserEntity
    {
        $userData = new UserData(
            null,
            $data['name'],
            $data['email'],
            $data['password'],
            null,
            null
        );
        $userEntity = $this->userEntityFactory->createByData($userData);

        return $this->createUserService->create($userEntity);
    }
}
