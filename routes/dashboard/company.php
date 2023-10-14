<?php
use App\Http\Controllers\Dashboard\Company;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix' => 'company','middleware' => 'auth:company'], function () {
            Route::get('dashboard', [Company\CompanyDashboardController::class, 'index'])->name('company.dashboard');
            // Captains ::
            Route::resource('companyCaptains', Company\CaptainController::class);
            Route::post('companyCaptains/{captainId}/update-password', [Company\CaptainController::class, 'updatePassword'])->name('companyCaptains.update-password');
            Route::get('companyCaptains/{captainId}/notifications', [Company\CaptainController::class, 'notifications'])->name('companyCaptains.notifications');
        });
    });