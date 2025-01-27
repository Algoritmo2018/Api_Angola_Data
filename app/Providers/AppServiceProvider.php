<?php

namespace App\Providers;

use App\Repositories\Municipality\MunicipalityEloquentORM;
use App\Repositories\Municipality\MunicipalityRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Province\ProvinceEloquentORM;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\Comune\ComuneEloquentORM;
use App\Repositories\Comune\ComuneRepositoryInterface;

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
                  $this->app->bind(
                           ComuneRepositoryInterface::class, ComuneEloquentORM::class
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
