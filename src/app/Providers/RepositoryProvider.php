<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// User
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

// Model
use App\Models\User;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
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
