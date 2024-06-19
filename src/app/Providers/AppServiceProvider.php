<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Auth
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\AuthService;

// GetUserEntity
use App\Services\GetUserEntity\GetUserEntityServiceInterface;
use App\Services\GetUserEntity\GetUserEntityService;

// SNSConnect
use App\Services\SNSAuth\SNSConnectServiceInterface;
use App\Services\SNSAuth\SNSConnectService;

// Factory
use App\Entities\Factory\UserEntityFactory;
// Repository
use App\Repositories\User\UserRepositoryInterface;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
