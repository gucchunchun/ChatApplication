<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Auth
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;
// ChatRoomMembership
use App\Services\ChatRoomMembership\ChatRoomMembershipServiceInterface;
use App\Services\ChatRoomMembership\ChatRoomMembershipService;
// GetAuthenticatedUserEntity
use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityServiceInterface;
use App\Services\GetAuthenticatedUserEntity\GetAuthenticatedUserEntityService;
// GetUserEntity
use App\Services\GetUserEntity\GetUserEntityServiceInterface;
use App\Services\GetUserEntity\GetUserEntityService;
// SNSConnect
use App\Services\SNSConnect\SNSConnectServiceInterface;
use App\Services\SNSConnect\SNSConnectService;

// CHAT MESSAGE
// Create
use App\Services\ChatMessage\CreateChatMessage\CreateChatMessageServiceInterface;
use App\Services\ChatMessage\CreateChatMessage\CreateChatMessageService;

// USER
// CreateUser
use App\Services\User\CreateUser\CreateUserServiceInterface;
use App\Services\User\CreateUser\CreateUserService;

// BINDING
// FACTORY
use App\Entities\Factory\ChatMessageEntityFactory;
use App\Entities\Factory\UserEntityFactory;
// REPOSITORY
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserChatRoom\UserChatRoomRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Auth
        $this->app->bind(AuthServiceInterface::class, function ($app) {
            return new AuthService(
                $app->make(UserEntityFactory::class),
                $app->make(UserRepositoryInterface::class),
            );
        });
        // ChatRoomMembership
        $this->app->bind(ChatRoomMembershipServiceInterface::class, function ($app) {
            return new ChatRoomMembershipService(
                $app->make(UserChatRoomRepositoryInterface::class)
            );
        });
        // GetAuthenticatedUserEntity
        $this->app->bind(GetAuthenticatedUserEntityServiceInterface::class, function ($app) {
            return new GetAuthenticatedUserEntityService(
                $app->make(UserEntityFactory::class),
            );
        });
        // GetUserEntity
        $this->app->bind(GetUserEntityServiceInterface::class, function ($app) {
            return new GetUserEntityService(
                $app->make(UserEntityFactory::class),
                $app->make(UserRepositoryInterface::class),
            );
        });
        // SNSConnect
        $this->app->bind(SNSConnectServiceInterface::class, function ($app) {
            return new SNSConnectService(
                $app->make(UserEntityFactory::class),
            );
        });

        // CHAT MESSAGE
        // Create
        $this->app->bind(CreateChatMessageServiceInterface::class, function ($app) {
            return new CreateChatMessageService(
                $app->make(ChatMessageEntityFactory::class),
                $app->make(ChatMessageRepositoryInterface::class),
            );
        });

        // USER
        // CreateUser
        $this->app->bind(CreateUserServiceInterface::class, function ($app) {
            return new CreateUserService(
                $app->make(UserEntityFactory::class),
                $app->make(UserRepositoryInterface::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
