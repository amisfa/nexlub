<?php

use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
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
Route::prefix('dashboard')->middleware('auth:web')->group(function () {
    Route::get('/', [DashboardController::class, 'create'])->name('dashboard');
});

Route::prefix('auth')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('signup');
    Route::post('/register', [RegisterController::class, 'store'])->name('signup-form');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login-form');
    Route::get('/forget-password', [ForgetPasswordController::class, 'create'])->name('forgot-password-view');;
    Route::post('/forget-password', [ForgetPasswordController::class, 'store'])->name('forget-password');
    Route::post('/log-out', [LogoutController::class, 'destroy'])->middleware('auth:web')->name('log-out');
    Route::get('/reset-password', [ResetPasswordController::class, 'create']);
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');
    Route::get('/email-validation', [EmailValidationController::class, 'emailVerify']);
});


