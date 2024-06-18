<?php

namespace App\Services\GetUserEntity;

use App\Services\GetUserEntity\GetUserEntityServiceInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Entities\UserEntity;

class GetUserEntityService implements GetUserEntityServiceInterface
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(string $userId): UserEntity
    {
        $user = $this->userRepository->findById($userId);

        return new UserEntity(
            $userId,
            $user->name,
            $user->email,
            $user->password
        );
    }
}
