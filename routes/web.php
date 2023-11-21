<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordLinkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register');
    Route::get('/login', [LoginController::class, 'create']);
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login');
    Route::post('/logout', [Logoutcontroller::class, 'destroy'])
        ->middleware('auth');
    Route::post('/forgot-password', [ForgotPasswordLinkController::class, 'store']);
    Route::post('/reset-password/{token}', [ForgotPasswordController::class, 'reset']);
    Route::get('/forgot-password', [ForgotPasswordLinkController::class, 'create']);
    Route::get('/reset-password', [ForgotPasswordController::class, 'create']);

});
