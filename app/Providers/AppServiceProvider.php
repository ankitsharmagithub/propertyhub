<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Repositories\PropertyTypeRepository;
use App\Interfaces\StateRepositoryInterface;
use App\Repositories\StateRepository;
use App\Interfaces\CityRepositoryInterface;
use App\Repositories\CityRepository;
use App\Interfaces\AmenityRepositoryInterface;
use App\Repositories\AmenityRepository;
use App\Interfaces\PropertyRepositoryInterface;
use App\Repositories\PropertyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            PropertyTypeRepositoryInterface::class,
            PropertyTypeRepository::class
        );
        $this->app->bind(
            StateRepositoryInterface::class,
            StateRepository::class
          );
          $this->app->bind(
            CityRepositoryInterface::class,
             CityRepository::class
            );
            $this->app->bind(
               AmenityRepositoryInterface::class,
               AmenityRepository::class
             );
             $this->app->bind(
                PropertyRepositoryInterface::class,
                PropertyRepository::class
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
