<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Entities\Factory\UserEntityFactory;

class FactoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserEntityFactory::class, function ($app) {
            return new UserEntityFactory();
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
