<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\UserKycRepositoryInterface::class,
            \App\Repositories\UserKycRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\PackageRepositoryInterface::class,
            \App\Repositories\PackageRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\UserInvestmentRepositoryInterface::class,
            \App\Repositories\UserInvestmentRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
