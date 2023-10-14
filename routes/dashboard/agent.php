<?php
use App\Http\Controllers\Dashboard\Agent;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix' => 'agent','middleware' => 'auth:agent'], function () {
            Route::get('dashboard', [Agent\AgentDashboardController::class, 'index'])->name('agent.dashboard');
            // Companies ::
            Route::resource('agentCompanies', Agent\CompanyController::class);
            Route::post('companies/{companyId}/update-password', [Agent\CompanyController::class, 'updatePassword'])->name('agentCompanies.update-password');
            // Captains ::
            Route::resource('agentCaptains', Agent\CaptainController::class);
            Route::post('agentCaptains/{captainId}/update-password', [Agent\CaptainController::class, 'updatePassword'])->name('agentCaptains.update-password');
            Route::get('agentCaptains/{captainId}/notifications', [Agent\CaptainController::class, 'notifications'])->name('agentCaptains.notifications');
            // Employees ::
            Route::resource('agentEmployees', Agent\EmployeeController::class);
            Route::post('agentEmployees/{employeeId}/update-password', [Agent\EmployeeController::class, 'updatePassword'])->name('agentEmployees.update-password');
        });
    });