<?php

namespace App\UseCases;

use App\Services\Auth\AuthServiceInterface;
use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Services\SNSAuth\SNSConnectServiceInterface;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\MissingNameException;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class SNSLoginUseCase
{
    private $authService;
    private $createUserService;
    private $SNSConnectService;
    public function __construct(
        AuthServiceInterface $authService, 
        CreateUserServiceInterface $createUserService,
        SNSConnectServiceInterface $SNSConnectService
    )
    {
        $this->authService = $authService;
        $this->createUserService = $createUserService;
        $this->SNSConnectService = $SNSConnectService;
    }

    /**
     * @return array ['new' => Is User New, 'user' => UserEntity]
     */
    public function gitHub(): array
    {
        try
        {
            $tempUserEntity = $this->SNSConnectService->handleSNSCallback(SNSProvider::GIT_HUB);

            $userEntity = $this->authService->authenticateWithSNS(SNSProvider::GIT_HUB, $tempUserEntity->getSNSId());
            return $this->loggedInAs($userEntity);
        }
        catch (AuthenticationException $e)
        {
            if(!$tempUserEntity->getName()) throw new MissingNameException($tempUserEntity->getData());

            return $this->registeredAs($this->createUserService->create($tempUserEntity));
        }
    }
    public function getGitHubRedirectUrl(): string
    {
        return $this->SNSConnectService->getRedirectUrl(SNSProvider::GIT_HUB);
    }

    private function loggedInAs(UserEntity $userEntity): array
    {
        return [
            'new' => false,
            'user' => $userEntity
        ];
    }
    private function registeredAs(UserEntity $userEntity): array
    {
        return [
            'new' => true,
            'user' => $userEntity
        ];
    }
}
