<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;

use App\Services\Auth\AuthServiceInterface;
use App\Entities\Factory\UserEntityFactory;
use App\Repositories\User\UserRepositoryInterface;
use App\Entities\UserEntity;
use App\Enum\SNSProvider;

class AuthService implements AuthServiceInterface
{
    private $userEntityFactory;
    private $userRepository;
    public function __construct(UserEntityFactory $userEntityFactory, UserRepositoryInterface $userRepository)
    {
        $this->userEntityFactory = $userEntityFactory;
        $this->userRepository = $userRepository;
    }

    public function authenticate(array $credentials): UserEntity
    {
        if (!Auth::attempt($credentials) ) 
        {
            throw new AuthenticationException();
        }

        $user = Auth::user();

        return $this->userEntityFactory->createByModel($user);
    }   

    public function authenticateWithSNS(SNSProvider $provider, string $snsId): UserEntity
    {
        $user = $this->userRepository->findBySNS($provider->value, $snsId);

        if (!$user) {
            throw new AuthenticationException();
        }
        
        Auth::login($user);

        return $this->userEntityFactory->createByModel($user);
    }
}
