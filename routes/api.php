<?php
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Setting\CarMakeController;
use App\Http\Controllers\Api\Setting\CarModelController;
use App\Http\Controllers\Api\Setting\CarTypeController;
use App\Http\Controllers\Api\Setting\CategoryCarController;
use App\Http\Controllers\Api\Setting\CheckCodeDiscountController;
use App\Http\Controllers\Api\Setting\CompanySupportController;
use App\Http\Controllers\Api\Setting\CountryController;
use App\Http\Controllers\Api\Setting\OfferController;
use App\Http\Controllers\Api\Setting\PackageController;
use App\Http\Controllers\Api\Setting\SosController;
use App\Http\Controllers\Api\Setting\SubscriptionController;
use App\Http\Controllers\Api\Setting\TripTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    require_api_routes();

    Route::get('countries', [CountryController::class, 'index']);
    Route::get('country/{id}', [CountryController::class, 'show']);

    // companySupport ::
    Route::get('companySupport', [CompanySupportController::class, 'index']);

    // CarMake ::
    Route::get('carMake', [CarMakeController::class, 'index']);
    Route::get('carMake/{id}', [CarMakeController::class, 'show']);

    // CarModel ::
    Route::get('carModel', [CarModelController::class, 'index']);
    Route::get('carModel/{id}', [CarModelController::class, 'show']);

    // TripType ::
    Route::get('tripType', [TripTypeController::class, 'index']);
    Route::get('tripType/{id}', [TripTypeController::class, 'show']);

    // TripType ::
    Route::get('carType', [CarTypeController::class, 'index']);
    Route::get('carType/{id}', [CarTypeController::class, 'show']);

    // TripType ::
    Route::get('categoryCar', [CategoryCarController::class, 'index']);
    Route::get('categoryCar/{id}', [CategoryCarController::class, 'show']);

    // Sos ::
    Route::get('sos', [SosController::class, 'index']);
    Route::get('sos/{id}', [SosController::class, 'show']);

    // package ::
    Route::get('package', [PackageController::class, 'index']);
    Route::get('package/{id}', [PackageController::class, 'show']);

    // Subscription ::
    Route::get('subscription', [SubscriptionController::class, 'index']);
    Route::get('subscription/{id}', [SubscriptionController::class, 'show']);

    // Offer ::
    Route::get('offer', [OfferController::class, 'index']);
    Route::get('offer/{id}', [OfferController::class, 'show']);

    // checkCodeDiscount ::
    Route::post('checkCodeDiscount', [CheckCodeDiscountController::class, 'checkCode']);

    // MainSetting ::
    Route::get('mainSetting', [Api\Setting\MainSettingController::class, 'index']);

    // accounts kilometer
    Route::post('accounts_kilometer',[Api\Setting\MainSettingController::class, 'accounts_kilometer']);

    // carYear
    Route::get('carYear',[Api\Setting\MainSettingController::class, 'carYear']);

    // CategoryCar
    Route::post('checkYears',[Api\Setting\MainSettingController::class, 'checkYears']);

    // AboutUs
    Route::get('aboutUs',[Api\Setting\MainSettingController::class, 'aboutUs']);

    //Conditions
    Route::get('conditions',[Api\Setting\MainSettingController::class, 'conditions']);

    //privacies
    Route::get('privacies',[Api\Setting\MainSettingController::class, 'privacies']);
});

