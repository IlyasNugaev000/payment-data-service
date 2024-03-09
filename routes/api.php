<?php

use App\Http\Controllers\Api\Aggregations\AggregationsController;
use App\Http\Controllers\Api\Payments\PaymentsController;
use Illuminate\Http\Request;
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

Route::prefix('payments')
    ->name('payments.')
    ->group(function () {
        Route::get('cloud-payments/{fund_id}', [PaymentsController::class, 'getCloudPayments'])->name('cloud-payments');
        Route::post('cloud-payments', [PaymentsController::class, 'storeCloudPaymentsCredentials'])->name('store-cloud-payments');
    });

Route::prefix('aggregations')
    ->name('aggregations.')
    ->group(function () {
        Route::prefix('cloud-payments')
            ->name('cloud-payments.')
            ->group(function () {
                Route::get('fund', [AggregationsController::class, 'getAggregationsDataByFund'])->name('get');
                Route::get('purpose', [AggregationsController::class, 'getAggregationsDataByPurpose'])->name('get');
            });
    });
