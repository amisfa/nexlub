<?php

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

Route::prefix('auth')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('signup');
    Route::post('/register', [RegisterController::class, 'store'])->name('register-form');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login-form');
    Route::post('/logout', [Logoutcontroller::class, 'destroy'])->middleware('auth');
    Route::get('/forgot-password', [ForgetPasswordController::class, 'create'])->name('forgot-pass');;
    Route::post('/forgot-password', [ForgetPasswordController::class, 'store'])->name('forget-password');
    Route::get('/reset-password', [ResetPasswordController::class, 'create']);
    Route::post('/reset-password/{token}/{email}', [ResetPasswordController::class, 'reset'])->name('reset-password');
});
Route::prefix('profile')->middleware('auth:web')->group(function () {
    Route::get('/', [DashboardController::class, 'create'])->name('dashboard');
});


