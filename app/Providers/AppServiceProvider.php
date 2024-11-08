<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\RegisterRepositoryInterface::class,
            \App\Repositories\RegisterRepository::class
        );
        $this->app->bind(
            \App\Interfaces\LoginRepositoryInterface::class,
            \App\Repositories\LoginRepository::class
        );
        $this->app->bind(
            \App\Interfaces\GroupRepositoryInterface::class,
            \App\Repositories\GroupRepository::class
        );
     }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
