<?php

use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Statics\StaticController;
use App\Http\Controllers\Statics\DepositController;
use App\Http\Controllers\Statics\InvoiceController;
use App\Http\Controllers\Statics\PaymentController;
use App\Http\Controllers\Statics\PlayController;
use App\Http\Controllers\Statics\ProfileController;
use App\Http\Controllers\Statics\UserManagementController;
use App\Http\Controllers\Statics\UserWithdrawController;
use App\Http\Controllers\Statics\WalletController;
use App\Http\Controllers\Statics\WithdrawManagementController;
use App\Http\Livewire\UserRake\AffiliateRakeView;
use App\Http\Livewire\UserRake\RakeBackView;
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
Route::get("/", function () {return view('home-page');})->name('home-page');
Route::prefix('statics')->middleware('auth:web')->group(function () {
    Route::get('/', [StaticController::class, 'create'])->name('statics');
    Route::get('/profile', [ProfileController::class, 'create'])->name('profile-view');
    Route::get('/edit-profile', [ProfileController::class, 'update'])->name('profile-edit');
    Route::put('/edit-user-details', [ProfileController::class, 'editUserDetails'])->name('edit-user-details');
    Route::put('/change-user-password', [ProfileController::class, 'changeUserPassword'])->name('change-user-password');
    Route::get('/wallet', [WalletController::class, 'create'])->name('wallet');
    Route::get('/play', [PlayController::class, 'create'])->name('play');
    Route::get('/rake-back', [RakeBackView::class, 'create'])->name('rake-back');
    Route::get('/invoices', [InvoiceController::class, 'create'])->name('invoices');
    Route::get('/subset', [AffiliateRakeView::class, 'create'])->name('subset');
    Route::get('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
    Route::get('/withdraw', [UserWithdrawController::class, 'create'])->name('withdraw');
    Route::post('/withdraw', [UserWithdrawController::class, 'makeWithdraw'])->name('make-withdraw');
//    Route::prefix('admin')->middleware(['role:manager'])->group(function () {
//    });
    Route::prefix('admin')->group(function () {
        Route::get('/user-management', [UserManagementController::class, 'create'])->name('user-management');
        Route::get('/withdraw-management', [WithdrawManagementController::class, 'create'])->name('withdraw-management');
        Route::post('/reject-withdraw/{withdraw}', [WithdrawManagementController::class, 'rejectWithdraw'])->name('reject-withdraw');
    });

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


