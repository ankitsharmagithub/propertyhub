<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyImageController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PropertyController as FrontendPropertyController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PropertyController as UserPropertyController;

use App\Http\Controllers\DeveloperController;


/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/properties', [
    FrontendPropertyController::class,
    'index'
])->name('properties.index');

Route::get('/properties/{slug}', [
    FrontendPropertyController::class,
    'show'
])->name('properties.show');


/*
|--------------------------------------------------------------------------
| Authenticated Dashboard Redirect
|--------------------------------------------------------------------------
|
| Login ke baad /dashboard hit hoga.
| Role ke according Admin/User dashboard par redirect hoga.
|
*/

Route::get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::post('/developers', [DeveloperController::class, 'store'])
        ->name('developers.store');

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth'])
    ->name('admin.')
    ->group(function () {

        /*
        | Admin Dashboard
        */

        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        | Common AJAX
        */

        Route::get(
            '/ajax/get-cities/{state}',
            [PropertyController::class, 'getCities']
        )->name('ajax.getCities');


        /*
        | Master Data
        */

        Route::resource('categories', CategoryController::class);

        Route::resource('property-types', PropertyTypeController::class);

        Route::resource('states', StateController::class);

        Route::resource('cities', CityController::class);

        Route::resource('amenities', AmenityController::class);


        /*
        | Properties
        */

        Route::resource('properties', PropertyController::class);


        /*
        | Property Gallery
        */

        Route::post(
            '/properties/{property}/gallery',
            [PropertyImageController::class, 'store']
        )->name('properties.gallery.store');

        Route::delete(
            '/properties/gallery/{image}',
            [PropertyImageController::class, 'destroy']
        )->name('properties.gallery.destroy');

    });


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')
    ->middleware(['auth'])
    ->name('user.')
    ->group(function () {

        /*
        | User Dashboard
        */

        Route::get('/dashboard', [
            UserDashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        | User Properties
        */

        Route::resource(
            'properties',
            UserPropertyController::class
        );


        /*
        | Property Gallery
        */

        Route::post(
            '/properties/{property}/gallery',
            [PropertyImageController::class, 'store']
        )->name('properties.gallery.store');

        Route::delete(
            '/properties/gallery/{image}',
            [PropertyImageController::class, 'destroy']
        )->name('properties.gallery.destroy');

    });


require __DIR__.'/auth.php';