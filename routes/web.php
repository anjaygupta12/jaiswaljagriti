<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\HomeController;

Route::get('/',  [HomeController::class, 'index']);
Route::get('/about',  [HomeController::class, 'about'])->name('about');
Route::get('/job',  [HomeController::class, 'job'])->name('job');
Route::get('/job/{jobListing}',  [HomeController::class, 'jobDetail'])->name('job.show');
Route::get('/youth-wing',  [HomeController::class, 'YouthWing'])->name('youth-wing');
Route::get('/executive-body',  [HomeController::class, 'ExecutiveBody'])->name('executive-body');
Route::get('/womens-wing',  [HomeController::class, 'womensWing'])->name('womens-wing');
Route::get('/upcoming-events',  [HomeController::class, 'upcommingEvents'])->name('events');
Route::get('/upcoming-events/{event:slug}',  [HomeController::class, 'upcommingEventsDeatils'])->name('events-details');

Route::get('/patrika-subscription',  [HomeController::class, 'patrikaSubscription'])->name('patrika-subscription');
Route::get('/advertisement-subscription',  [HomeController::class, 'advertisementSubscription'])->name('advertisement-subscription');
Route::get('/plans/{plan}/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscribe')->middleware('auth');
Route::post('/plans/{plan}/subscribe', [\App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscribe.store')->middleware('auth');
Route::get('/magazines', [\App\Http\Controllers\MagazineController::class, 'index'])->name('magazines.index');
Route::get('/magazine/{magazine:slug}', [\App\Http\Controllers\MagazineController::class, 'show'])->name('magazines.show');
Route::get('/gallery', [\App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\HomeController::class, 'contactSubmit'])->name('contact.submit');

// Spiritual Yatras Routes
Route::get('/spiritual-yatras', [\App\Http\Controllers\SpiritualYatraController::class, 'index'])->name('spiritual-yatras.index');
Route::get('/spiritual-yatras/{slug}', [\App\Http\Controllers\SpiritualYatraController::class, 'show'])->name('spiritual-yatras.show');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/details', [App\Http\Controllers\ProfileController::class, 'updateDetails'])->name('profile.details.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    Route::get('/job/{jobListing}/apply', [App\Http\Controllers\JobApplicationController::class, 'create'])->name('job.apply');
    Route::post('/job/{jobListing}/apply', [App\Http\Controllers\JobApplicationController::class, 'store'])->name('job.apply.store');
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
            Route::resource('subscriptions', App\Http\Controllers\Admin\SubscriptionController::class)->only(['index', 'show', 'update', 'create', 'store']);
            Route::resource('banners', App\Http\Controllers\Admin\BannerController::class)->except(['show']);
            Route::resource('advertisement-patrikas', App\Http\Controllers\Admin\AdvertisementPatrikaController::class)->except(['show']);
            Route::resource('advertisement-normals', App\Http\Controllers\Admin\AdvertisementNormalController::class)->except(['show']);
            Route::post('advertisement-types', [App\Http\Controllers\Admin\AdvertisementNormalController::class, 'storeType'])->name('advertisement-types.store');
            Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);
            Route::resource('magazines', App\Http\Controllers\Admin\MagazineController::class)->except(['show']);
            Route::resource('job-categories', App\Http\Controllers\Admin\JobCategoryController::class);
            Route::resource('job-listings', App\Http\Controllers\Admin\JobListingController::class);
            Route::resource('job-applications', App\Http\Controllers\Admin\JobApplicationController::class)->only(['index', 'show', 'destroy']);
            Route::patch('job-applications/{job_application}/status', [App\Http\Controllers\Admin\JobApplicationController::class, 'updateStatus'])->name('job-applications.status');
            Route::resource('event-categories', App\Http\Controllers\Admin\EventCategoryController::class);
            Route::resource('events', App\Http\Controllers\Admin\EventController::class);
            Route::delete('events/delete-image/{image}', [App\Http\Controllers\Admin\EventController::class, 'deleteImage'])->name('events.delete-image');
            Route::resource('spiritual-yatras', App\Http\Controllers\Admin\SpiritualYatraController::class)->except(['show']);
            Route::resource('wing-members', App\Http\Controllers\Admin\WingMemberController::class);
            Route::get('wing-banners', [App\Http\Controllers\Admin\WingBannerController::class, 'index'])->name('wing-banners.index');
            Route::post('wing-banners', [App\Http\Controllers\Admin\WingBannerController::class, 'store'])->name('wing-banners.store');
            Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
            Route::get('/events-banner', [App\Http\Controllers\Admin\SettingController::class, 'eventsBannerIndex'])->name('events-banner.index');
            Route::post('/events-banner', [App\Http\Controllers\Admin\SettingController::class, 'eventsBannerUpdate'])->name('events-banner.update');

            Route::get('/settings/home-welcome', [\App\Http\Controllers\Admin\SettingController::class, 'homeWelcomeIndex'])->name('home-welcome.index');
            Route::post('/settings/home-welcome', [\App\Http\Controllers\Admin\SettingController::class, 'homeWelcomeUpdate'])->name('home-welcome.update');
    
            // Home Magazine Settings Routes
            Route::get('/settings/home-magazine', [\App\Http\Controllers\Admin\SettingController::class, 'homeMagazineIndex'])->name('home-magazine.index');
            Route::post('/settings/home-magazine', [\App\Http\Controllers\Admin\SettingController::class, 'homeMagazineUpdate'])->name('home-magazine.update');

            // Footer Settings
            Route::get('/settings/footer', [\App\Http\Controllers\Admin\SettingController::class, 'footerIndex'])->name('footer.index');
            Route::post('/settings/footer', [\App\Http\Controllers\Admin\SettingController::class, 'footerUpdate'])->name('footer.update');

            Route::post('/logout', [App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');
            Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
            Route::get('contact-page', [App\Http\Controllers\Admin\SettingController::class, 'contactIndex'])->name('contact-page.index');
            Route::post('contact-page', [App\Http\Controllers\Admin\SettingController::class, 'contactUpdate'])->name('contact-page.update');
            Route::get('about-page', [App\Http\Controllers\Admin\SettingController::class, 'aboutIndex'])->name('about-page.index');
            Route::post('about-page', [App\Http\Controllers\Admin\SettingController::class, 'aboutUpdate'])->name('about-page.update');
        });

    });



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
