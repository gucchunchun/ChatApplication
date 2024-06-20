<?php

namespace App\Services\GetUserEntity;

use App\Services\GetUserEntity\GetUserEntityServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Repositories\User\UserRepositoryInterface;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class GetUserEntityService implements GetUserEntityServiceInterface
{
    private $userEntityFactory;
    private $userRepository;
    public function __construct(UserEntityFactory $userEntityFactory, UserRepositoryInterface $userRepository)
    {
        $this->userEntityFactory = $userEntityFactory;
        $this->userRepository = $userRepository;
    }

    public function getById(string $userId): ?UserEntity
    {
        $user = $this->userRepository->findById($userId);

        if (!$user) return null;

        return $this->userEntityFactory->createByModel($user);
    }
    public function getBySNS(SNSProvider $provider, string $snsId): ?UserEntity
    {
        $user = $this->userRepository->findBySNS($provider->value, $snsId);

        if (!$user) return null;

        return $this->userEntityFactory->createByModel($user);
    }
}
