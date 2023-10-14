<?php

use App\Http\Controllers\Api\complaint\ComplaintController;
use App\Http\Controllers\Api\Orders\OrdersController;
use App\Http\Controllers\Api\Wallet\WalletController;
use Illuminate\Support\Facades\Route;
Route::post('rest',[OrdersController::class, 'rest']);
Route::group(['prefix' => 'order', 'middleware' => 'auth:users-api,captain-api'], function () {
    Route::post('getOrder', [OrdersController::class, 'index']);
    Route::post('createOrder', [OrdersController::class, 'store']);
    Route::post('updateStatus', [OrdersController::class, 'update']);
    Route::post('takingOrder', [OrdersController::class, 'takingOrder']);
    Route::post('takingCompleted', [OrdersController::class, 'takingCompleted']);
    Route::post('canselOrder', [OrdersController::class, 'canselOrder']);
    // Deleted Orders
//    Route::post('deletedOrder', [OrdersController::class, 'deletedOrder']);
    Route::post('checkOrder', [OrdersController::class, 'checkOrder']);
    Route::get('sendNotationsCalculator', [OrdersController::class, 'sendNotationsCalculator']);
    Route::post('OrderExiting', [OrdersController::class, 'OrderExiting']);
});


Route::group(['prefix' => 'wallet', 'middleware' => 'auth:users-api,captain-api'], function () {
    Route::post('getAmounts', [WalletController::class, 'index']);
    Route::post('createAmounts', [WalletController::class, 'store']);
});


Route::group(['prefix' => 'complaint', 'middleware' => 'auth:users-api,captain-api'], function () {
    Route::post('complaint', [ComplaintController::class, 'store']);
});
