<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Drivers\CaptainController;
use App\Http\Controllers\Api\Drivers\CaptainProfileController;
use App\Http\Controllers\Api\Drivers\DriverAuthController;
use App\Http\Controllers\Api\Drivers\NotificationsController;
use App\Http\Controllers\Api\Drivers\OrderController;
use App\Http\Controllers\Api\Drivers\RateCommentController;
use App\Http\Controllers\Api\Users\AuthController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'driver'
], function ($router) {
    Route::post('/login', [DriverAuthController::class, 'login']);
    Route::post('/login_phone', [DriverAuthController::class, 'login_phone']);
    Route::post('/register', [DriverAuthController::class, 'register']);
    Route::post('/logout', [DriverAuthController::class, 'logout']);
    Route::post('/refresh', [DriverAuthController::class, 'refresh']);
    Route::get('/drivers-profile', [DriverAuthController::class, 'userProfile']);
    Route::post('/change-password', [DriverAuthController::class, 'changePassword']);
    Route::post('/change-password', [DriverAuthController::class, 'changePassword']);
    Route::post('restPassword', [DriverAuthController::class, 'restPassword']);
    Route::post('checkPhone', [DriverAuthController::class, 'checkPhone']);
});


Route::group(['middleware' => 'auth:captain-api' ,'prefix' => 'driver'], function () {
    Route::get('getNotifications',[NotificationsController::class,'getNotifications']);
    Route::post('updateStatus',[CaptainController::class,'updateStatus']);
    Route::post('checkStatusCaptain',[CaptainController::class,'checkStatusCaptain']);
    Route::post('StatusCaptain',[CaptainController::class,'StatusCaptain']);
    Route::get('allOrders',[OrderController::class,'index']);

    Route::prefix('profile')->group(function () {

        Route::get('getProfile', [CaptainProfileController::class, 'index']);
        Route::post('update_profile', [CaptainProfileController::class, 'updateProfile']);
        Route::get('getCar', [CaptainProfileController::class, 'getCar']);
        Route::post('storeCar', [CaptainProfileController::class, 'storeCar']);
        Route::prefix('media')->group(function () {
            Route::post('uploadProfile', [CaptainProfileController::class, 'uploadProfile']);
            Route::post('updateUploadProfile', [CaptainProfileController::class, 'updateUploadProfile']);
            Route::post('getRejectMedia', [CaptainProfileController::class, 'getRejectMedia']);
            Route::post('allMedia', [CaptainProfileController::class, 'allMedia']);
            Route::post('checkImg', [CaptainProfileController::class, 'checkImg']);
        });

        Route::post('uploadCarPhoto', [CaptainProfileController::class, 'uploadCarPhoto']);
        Route::post('getCaptainPhotosWithStatus',[CaptainProfileController::class, 'getCaptainPhotosWithStatus']);
        Route::post('getCaptainCarsPhotosWithStatus',[CaptainProfileController::class, 'getCaptainCarsPhotosWithStatus']);
        Route::post('checkUploadfilesOrNot',[CaptainProfileController::class, 'checkUploadfilesOrNot']);
        Route::post('updatedNewPhotos',[CaptainProfileController::class,'updatedNewPhotos']);
    });

    Route::prefix('rate')->group(function () {
        Route::get('getRate', [RateCommentController::class, 'index']);
        Route::post('createRate', [RateCommentController::class, 'store']);
    });
});
