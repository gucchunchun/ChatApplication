<?php

namespace App\Services\SNSConnect;

use Laravel\Socialite\Facades\Socialite;

use App\Services\SNSConnect\SNSConnectServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Enum\SNSProvider;
use App\Entities\UserEntity;
use App\DTO\UserData;

class SNSConnectService implements SNSConnectServiceInterface
{
    private $userEntityFactory;
    public function __construct(UserEntityFactory $userEntityFactory)
    {
        $this->userEntityFactory = $userEntityFactory;
    }
    public function handleSNSCallback(SNSProvider $provider): UserEntity
    {
        $user = Socialite::driver($provider->value)->user();

        $userData = new UserData(
            null,
            $user->getNickname(),
            $user->getEmail(),
            null,
            $provider,
            $user->getId()
        );

        return $this->userEntityFactory->createByData($userData);
    }
    public function getRedirectUrl(SNSProvider $provider): string
    {
        return Socialite::driver($provider->value)->redirect()->getTargetUrl();
    }
}
