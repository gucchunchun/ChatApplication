<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// ChatMessage
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use App\Repositories\ChatMessage\ChatMessageRepository;
// User
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
// UserChatRoom
use App\Repositories\UserChatRoom\UserChatRoomRepositoryInterface;
use App\Repositories\UserChatRoom\UserChatRoomRepository;

// Model
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\UserChatRoom;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // ChatMessage
        $this->app->singleton(ChatMessageRepositoryInterface::class, function ($app) {
            return new ChatMessageRepository(
                $app->make(ChatMessage::class)
            );
        });
        // User
        $this->app->singleton(UserRepositoryInterface::class, function ($app) {
            return new UserRepository(
                $app->make(User::class)
            );
        });
        // UserChatRoom
        $this->app->singleton(UserChatRoomRepositoryInterface::class, function ($app) {
            return new UserChatRoomRepository(
                $app->make(UserChatRoom::class)
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
