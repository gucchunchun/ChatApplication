<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// ChatMessage
use App\Repositories\ChatMessage\ChatMessageRepositoryInterface;
use App\Repositories\ChatMessage\ChatMessageRepository;
// User
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

// Model
use App\Models\ChatMessage;
use App\Models\User;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
