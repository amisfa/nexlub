<?php

use App\Http\Controllers\Dashboard\PaymentController;
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
    Route::get('/get-estimated-price', [PaymentController::class, 'getEstimatedPrice'])->name('get-estimated-price');
});
