<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\HomeController;

Route::get('/',  [HomeController::class, 'index']);
Route::get('/about',  [HomeController::class, 'about'])->name('about');
Route::get('/job',  [HomeController::class, 'job'])->name('job');
Route::get('/youth-wing',  [HomeController::class, 'YouthWing'])->name('youth-wing');
Route::get('/executive-body',  [HomeController::class, 'ExecutiveBody'])->name('executive-body');
Route::get('/womens-wing',  [HomeController::class, 'womensWing'])->name('womens-wing');
Route::get('/events',  [HomeController::class, 'events'])->name('events');
Route::get('/patrika-subscription',  [HomeController::class, 'patrikaSubscription'])->name('patrika-subscription');
Route::get('/advertisement-subscription',  [HomeController::class, 'advertisementSubscription'])->name('advertisement-subscription');
Route::get('/plans/{plan}/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscribe')->middleware('auth');
Route::post('/plans/{plan}/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscribe.store')->middleware('auth');
Route::get('/magazines', [\App\Http\Controllers\MagazineController::class, 'index'])->name('magazines.index');
Route::get('/magazine/{magazine:slug}', [\App\Http\Controllers\MagazineController::class, 'show'])->name('magazines.show');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/details', [App\Http\Controllers\ProfileController::class, 'updateDetails'])->name('profile.details.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});
   Route::get('/admin', [AdminLoginController::class, 'index'])
        ->name('admin.login');
    Route::get('/admin/login', [AdminLoginController::class, 'index'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminLoginController::class, 'login'])
        ->name('admin.login.submit');

    /*
    |--------------------------------------------------------------------------
    | Admin Protected Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('plans', App\Http\Controllers\Admin\PlanController::class);
            Route::resource('subscriptions', App\Http\Controllers\Admin\SubscriptionController::class)->only(['index', 'show', 'update']);
            Route::resource('banners', App\Http\Controllers\Admin\BannerController::class)->except(['show']);
            Route::resource('magazines', App\Http\Controllers\Admin\MagazineController::class)->except(['show']);
        });

    });



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
