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
use App\Http\Controllers\Frontend\DeveloperController;


/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------
*/


Route::get('/', [HomeController::class, 'index'])->name('home');

// Property Type – top-level (SEO-friendly)
Route::get('/property-type/{type}', [FrontendPropertyController::class, 'byType'])
    ->name('property.type');

Route::prefix('properties')->name('properties.')->group(function () {
    Route::get('/', [FrontendPropertyController::class, 'index'])->name('index');
    Route::get('/{city}', [FrontendPropertyController::class, 'city'])->name('city');
    Route::get('/{city}/{slug}', [FrontendPropertyController::class, 'citySlug'])->name('city.slug');
});

// 301 Redirect: Old /properties/type/{slug} → /property-type/{slug}
Route::get('/properties/type/{slug}', function ($slug) {
    return redirect('/property-type/' . $slug, 301);
});

// 5. OLD detail route – 301 redirect to new canonical (optional but recommended)
Route::get('/properties/{slug}', function ($slug) {
    $property = \App\Models\Property::where('slug', $slug)->firstOrFail();
    return redirect()->route('properties.city.slug', [$property->city->slug, $property->slug], 301);
})->name('properties.old.show');


// AJAX location search
Route::get('/ajax/property-locations', [FrontendPropertyController::class, 'locations'])
    ->name('ajax.property.locations');

Route::get('/developer/{slug}', [DeveloperController::class, 'show'])->name('developer.detail');



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

    Route::get('/profile', [\App\Http\Controllers\User\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\User\ProfileController::class, 'destroy'])->name('profile.destroy');

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

        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])
            ->name('users.show');

        Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])
            ->name('users.update');

        Route::patch('/users/{user}/status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])
            ->name('users.status');

        Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
            ->name('users.destroy');

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
