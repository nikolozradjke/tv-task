<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Tvcode\Interfaces\TvCodeRepositoryInterface;
use App\Repositories\Tvcode\TvCodeRepository;

class TvCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TvCodeRepositoryInterface::class, TvCodeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
