<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserAuthTokenService;

class UserTokenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserAuthTokenService::class, function ($app) {
            return new UserAuthTokenService();
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
