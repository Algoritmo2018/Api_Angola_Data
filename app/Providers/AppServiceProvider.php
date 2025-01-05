<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Province\ProvinceEloquentORM;
use App\Repositories\Province\ProvinceRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
   $this->app->bind(
            ProvinceRepositoryInterface::class, ProvinceEloquentORM::class
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
