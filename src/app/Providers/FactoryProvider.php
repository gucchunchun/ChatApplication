<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Entities\Factory\ChatMessageEntityFactory;
use App\Entities\Factory\ChatRoomEntityFactory;
use App\Entities\Factory\UserEntityFactory;

class FactoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ChatMessageEntityFactory::class, function ($app) {
            return new ChatMessageEntityFactory(
                $app->make(ChatRoomEntityFactory::class),
                $app->make(UserEntityFactory::class),
            );
        });
        $this->app->singleton(ChatRoomEntityFactory::class, function ($app) {
            return new ChatRoomEntityFactory();
        });
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
