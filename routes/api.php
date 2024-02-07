<?php

use App\Helpers\Helper;
use App\Http\Controllers\User\ProfileController;
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
//
Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('/get-wallet-balance', [Helper::class, 'getWalletBalance'])->name('get-wallet-balance');
    Route::post('/resend-email/{user}', [ProfileController::class, 'resendEmail'])->name('resend-email');
});
Route::prefix('v1')->middleware('mavens:api')->group(function () {
    Route::post('/get-mavens-data', [Helper::class, 'balanceUpdate']);
});
