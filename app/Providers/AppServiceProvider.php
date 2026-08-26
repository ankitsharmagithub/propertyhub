<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
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
     View::composer('layouts.frontend.navbar', function ($view) {
        $developers = Category::where('status', 1)->orderBy('sort_order', 'asc')->get();
        $view->with('developers', $developers);
    });
    }
}
