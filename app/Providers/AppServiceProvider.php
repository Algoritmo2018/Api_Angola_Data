<?php

namespace App\Providers;

use App\Repositories\Municipality\MunicipalityEloquentORM;
use App\Repositories\Municipality\MunicipalityRepositoryInterface;
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
             $this->app->bind(
                      MunicipalityRepositoryInterface::class, MunicipalityEloquentORM::class
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
