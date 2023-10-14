<?php
use App\Http\Controllers\Dashboard\Employee;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix' => 'employee','middleware' => 'auth:employee'], function () {
            Route::get('dashboard', [Employee\EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
            // Captains ::
            Route::resource('employeeCaptains', Employee\CaptainController::class);
            Route::post('employeeCaptains/{captainId}/update-password', [Employee\CaptainController::class, 'updatePassword'])->name('employeeCaptains.update-password');
        });
    });