<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// USE CASE
// Login
use App\UseCases\LoginUseCase;
// SNSLogin
use App\UseCases\SNSLoginUseCase;

// BINDING
// SERVICE
use App\Services\Auth\AuthServiceInterface;
use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Services\SNSAuth\SNSConnectServiceInterface;


class UseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoginUseCase::class, function ($app) {
            return new LoginUseCase(
                $app->make(AuthServiceInterface::class)
            );
        });
        $this->app->bind(SNSLoginUseCase::class, function ($app) {
            return new SNSLoginUseCase(
                $app->make(AuthServiceInterface::class),
                $app->make(CreateUserServiceInterface::class),
                $app->make(SNSConnectServiceInterface::class),
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
