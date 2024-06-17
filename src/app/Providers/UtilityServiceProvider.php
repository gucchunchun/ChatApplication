<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utilities\DirectoryManipulator;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DirectoryManipulator::class, function ($app) {
            return new DirectoryManipulator($app['files']);
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
