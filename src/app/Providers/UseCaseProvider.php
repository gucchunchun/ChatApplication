<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// USE CASE
// Login
use App\UseCases\LoginUseCase;

// BINDING
// SERVICE
// Auth
use App\Services\Auth\AuthServiceInterface;


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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
