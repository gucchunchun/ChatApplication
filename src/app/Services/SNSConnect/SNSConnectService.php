<?php

namespace App\Services\SNSAuth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;

use App\Entities\Factory\UserEntityFactory;
use App\Enum\SNSProvider;
use App\Entities\UserEntity;

class SNSConnectService
{
    private $userEntityFactory;
    public function __construct(UserEntityFactory $userEntityFactory)
    {
        $this->userEntityFactory = $userEntityFactory;
    }
    public function handleSNSCallback(SNSProvider $provider): UserEntity
    {
        $user = Socialite::driver($provider->value)->user();

        $userData = [
            'name' => $user->getNickname(),
            'email' => $user->getEmail(),
            'provider' => $provider,
            'snsId' => $user->getId()
        ];

        return $this->userEntityFactory->createByData($userData);
    }
    public function getRedirectUrl(SNSProvider $provider): string
    {
        return Socialite::driver($provider->value)->redirect()->getTargetUrl();
    }
}
