<?php

namespace App\UseCases;

use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Entities\UserEntity;

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
        $userEntity = $this->userEntityFactory->createByData($data);

        return $this->createUserService->create($userEntity);
    }
}
