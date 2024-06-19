<?php

namespace App\UseCases;

use App\Entities\UserEntity;

use App\Services\Auth\AuthServiceInterface;

class LoginUseCase
{
    const CREDENTIALS = ['email', 'password'];
    private $authService;
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param array $credentials Requestでバリデーション済みの値。LoginUseCase自体に設定されているKeyの値のみを使用して認証を行う。
     * @return UserEntity 完了：UserEntity、不可：AuthenticationException
     */
    public function execute(array $credentials): UserEntity
    {
        $credentials = array_filter($credentials, function ($key){
            return in_array($key, self::CREDENTIALS);
        }, ARRAY_FILTER_USE_KEY);

        return $this->authService->authenticate($credentials);
    }
}
