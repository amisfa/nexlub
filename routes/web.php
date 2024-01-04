<?php

use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepositController;
use App\Http\Controllers\dashboard\InvoiceController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\PlayController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\WalletController;
use App\Http\Controllers\Dashboard\WithdrawController;
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
    Route::get('/profile', [ProfileController::class, 'create'])->name('profile-view');
    Route::get('/edit-profile', [ProfileController::class, 'update'])->name('profile-edit');
    Route::put('/edit-user-details', [ProfileController::class, 'editUserDetails'])->name('edit-user-details');
    Route::put('/change-user-password', [ProfileController::class, 'changeUserPassword'])->name('change-user-password');
    Route::get('/wallet', [WalletController::class, 'create'])->name('wallet');
    Route::get('/play', [PlayController::class, 'create'])->name('play');
    Route::get('/invoices', [InvoiceController::class, 'create'])->name('invoices');
    Route::get('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('withdraw');

    Route::get('/success-payment', [InvoiceController::class, 'successPayment']);
    Route::get('/failed-payment', [InvoiceController::class, 'failedPayment']);
    Route::get('/payments', [PaymentController::class, 'create'])->name('payments');

    Route::post('/create-invoice', [InvoiceController::class, 'makeInvoice'])->name('make-invoice');
    Route::get('/deposit', [DepositController::class, 'create'])->name('deposit');
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


