<?php

use App\Http\Controllers\Dashboard\Admin;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('dashboard', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        // Admins ::
        Route::resource('admins', Admin\AdminController::class);
        Route::post('admins/{adminId}/update-password', [Admin\AdminController::class, 'updatePassword'])->name('admins.update-password');

        // users ::
        Route::resource('users', Admin\UserController::class);
        Route::post('users/{adminId}/update-password', [Admin\UserController::class, 'updatePassword'])->name('users.update-password');
        Route::post('users/sendNotification/all', [Admin\UserController::class, 'sendNotificationAll'])->name('users.sendNotificationAll');
        Route::post('users/sendNotification', [Admin\UserController::class, 'sendNotification'])->name('users.sendNotification');
        // Agents ::
        Route::resource('agents', Admin\AgentController::class);
        Route::post('agents/{agentId}/update-password', [Admin\AgentController::class, 'updatePassword'])->name('agents.update-password');
        // Companies ::
        Route::resource('companies', Admin\CompanyController::class);
        Route::post('companies/{companyId}/update-password', [Admin\CompanyController::class, 'updatePassword'])->name('companies.update-password');
        // Employees ::
        Route::resource('employees', Admin\EmployeeController::class);
        Route::post('employees/{employeeId}/update-password', [Admin\EmployeeController::class, 'updatePassword'])->name('employees.update-password');
        // Captains ::
        Route::resource('captains', Admin\CaptainController::class);
        Route::get('captains/Orders/get', [Admin\CaptainController::class, 'getOrders'])->name('captains.getOrders');
        Route::post('captains/{captainId}/update-password', [Admin\CaptainController::class, 'updatePassword'])->name('captains.update-password');
        Route::put('/captains/{id}/updateStatus', [Admin\CaptainController::class, 'updateActivityStatus'])->name('captain.updateActivityStatus');
        Route::get('captains/{captainId}/notifications', [Admin\CaptainController::class, 'notifications'])->name('captains.notifications');
        Route::post('captains/{captainId}/sendNotifications', [Admin\CaptainController::class, 'sendNotifications'])->name('captains.sendNotifications');
        Route::get('captains/{captainId}/getCaptainActivity', [Admin\CaptainController::class, 'getCaptainActivity'])->name('captains.activity');
        
        Route::post('/captains/upload-media', [Admin\CaptainController::class, 'uploadPersonalMedia'])->name('captains.uploadMedia');
        Route::post('/captains/update-media-status/{id}', [Admin\CaptainController::class, 'updatePersonalMediaStatus'])->name('captains.updateMediaStatus');

        Route::post('captains/update-status/{id}', [Admin\CaptainController::class, 'updateStatus'])->name('captains.updateStatus');
        Route::post('captains/update-car-status/{id}', [Admin\CaptainController::class, 'updateCarStatus'])->name('captains.updateCarStatus');
        Route::post('captains/sendNotification/All', [Admin\CaptainController::class, 'sendNotificationAll'])->name('captains.sendNotificationAll');
        Route::post('captains/sendNotification', [Admin\CaptainController::class, 'sendNotification'])->name('captains.sendNotification');

        // Sos ::
        Route::resource('sos', Admin\SosController::class);
        Route::post('sos/{sosId}/update-status', [Admin\SosController::class, 'updateStatus'])->name('sos.update-status');
        // Trips-Type ::
        Route::resource('tripType', Admin\TripTypeController::class);
        Route::post('tripType/{tripId}/update-status', [Admin\TripTypeController::class, 'updateStatus'])->name('tripType.update-status');
        // Car-Type ::
        Route::resource('carType', Admin\Cars\CarTypeController::class);
        Route::post('carType/{carTypeId}/update-status', [Admin\Cars\CarTypeController::class, 'updateStatus'])->name('carType.update-status');
        // Car-Make ::
        Route::resource('carMake', Admin\Cars\CarMakeController::class);
        Route::post('carMake/{carCategoryId}/update-status', [Admin\Cars\CarMakeController::class, 'updateStatus'])->name('carMake.update-status');
        // Car-Categories ::
        Route::resource('carCategories', Admin\Cars\CarCategoryController::class);
        Route::post('carCategories/{carCategoryId}/update-status', [Admin\Cars\CarCategoryController::class, 'updateStatus'])->name('carCategories.update-status');
        // Car-Model ::
        Route::resource('carModel', Admin\Cars\CarModelController::class);
        Route::post('carModel/{carCategoryId}/update-status', [Admin\Cars\CarModelController::class, 'updateStatus'])->name('carModel.update-status');
        // Main Settings ::
        Route::controller(Admin\SettingsController::class)->prefix('mainSettings')->as('mainSettings.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
    });
});
