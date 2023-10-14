<?php

use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Users\OrderController;
use App\Http\Controllers\Api\Users\AuthController;
use App\Http\Controllers\Api\Users\CaptionActivityUserController;
use App\Http\Controllers\Api\Users\NotificationsController;
use App\Http\Controllers\Api\Users\RateCommentController;
use App\Http\Controllers\Api\Users\UserSubscriptionController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/login_phone', [AuthController::class, 'login_phone']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/edit-profile', [AuthController::class, 'editProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('restPassword', [AuthController::class, 'restPassword']);
    Route::post('checkPhone', [AuthController::class, 'checkPhone']);
    Route::post('editImages', [AuthController::class, 'editImages']);
});


Route::group(['middleware' => 'auth:users-api', 'prefix' => 'user'], function () {
    Route::get('getNotifications', [NotificationsController::class, 'getNotifications']);
    Route::post('userSubscription', [UserSubscriptionController::class, 'subscription']);
    Route::post('captionActivity', [CaptionActivityUserController::class, 'captionActivity']);

    Route::prefix('rate')->group(function () {
        Route::get('getRate', [RateCommentController::class, 'index']);
        Route::post('createRate', [RateCommentController::class, 'store']);
    });

    Route::prefix('order')->group(function () {
        Route::get('allOrder',[OrderController::class,'index']);
        Route::get('lastOrder',[OrderController::class,'lasts']);
    });

});
