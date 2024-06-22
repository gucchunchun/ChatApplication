<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// USE CASE
// Login
use App\UseCases\LoginUseCase;
// SendMessage
use App\UseCases\SendMessageUseCase;
// SNSLogin
use App\UseCases\SNSLoginUseCase;

// BINDING
// SERVICE
use App\Services\Auth\AuthServiceInterface;
use App\Services\ChatMessage\CreateChatMessage\CreateChatMessageServiceInterface;
use App\Services\ChatRoomMembership\ChatRoomMembershipServiceInterface;
use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityServiceInterface;
use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Services\SNSConnect\SNSConnectServiceInterface;


class UseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Login
        $this->app->bind(LoginUseCase::class, function ($app) {
            return new LoginUseCase(
                $app->make(AuthServiceInterface::class)
            );
        });
        // SendMessage
        $this->app->bind(SendMessageUseCase::class, function ($app) {
            return new SendMessageUseCase(
                $app->make(ChatRoomMembershipServiceInterface::class),
                $app->make(CreateChatMessageServiceInterface::class),
                $app->make(GetAuthenticatedUserEntityServiceInterface::class),
            );
        });
        // SNSLogin
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
