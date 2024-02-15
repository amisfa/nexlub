<?php

use App\Helpers\Helper;
use App\Http\Controllers\Auth\EmailValidationController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Statics\StaticController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PlayController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserManagementController;
use App\Http\Controllers\User\UserWithdrawController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\WithdrawManagementController;
use App\Http\Livewire\Ticket;
use App\Http\Livewire\TicketManagement;
use App\Http\Livewire\UserRake\AffiliateRakeView;
use App\Http\Livewire\UserRake\BadBeatRewardView;
use App\Http\Livewire\UserRake\JackPotRewardView;
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

Route::get("/", function () {
    Helper::getHistoryLog();
//    return view('home-page');
})->name('home-page');
Route::any('/{page?}', function () {
    return view('errors.404');
});

Route::prefix('dashboard')->middleware('auth:web')->group(function () {
    Route::get('/statics', [StaticController::class, 'create'])->name('statics');
    Route::get('/profile', [ProfileController::class, 'create'])->name('profile-view');
    Route::get('/edit-profile', [ProfileController::class, 'update'])->name('profile-edit');
    Route::put('/edit-user-details', [ProfileController::class, 'editUserDetails'])->name('edit-user-details');
    Route::put('/change-user-password', [ProfileController::class, 'changeUserPassword'])->name('change-user-password');
    Route::get('/wallet', [WalletController::class, 'create'])->name('wallet');
    Route::get('/play', [PlayController::class, 'create'])->name('play');
    Route::get('/rake-back', [RakeBackView::class, 'create'])->name('rake-back');
    Route::get('/deposit', [InvoiceController::class, 'create'])->name('deposit');
    Route::post('/deposit', [InvoiceController::class, 'makeInvoice'])->name('make-invoice');
    Route::get('/referral', [AffiliateRakeView::class, 'create'])->name('referral');
    Route::get('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('create-invoice');
    Route::get('/withdraw', [UserWithdrawController::class, 'create'])->name('withdraw');
    Route::get('/jack-pot-reward', [JackPotRewardView::class, 'create'])->name('jack-pot');
    Route::get('/bad-beat-reward', [BadBeatRewardView::class, 'create'])->name('bad-beat');
    Route::post('/withdraw', [UserWithdrawController::class, 'makeWithdraw'])->name('make-withdraw');
    Route::get('/tickets', [Ticket::class, 'render'])->name('tickets');
    Route::prefix('admin')->middleware('role:Administrator')->group(function () {
        Route::get('/user-management', [UserManagementController::class, 'create'])->name('user-management');
        Route::get('/withdraw-management', [WithdrawManagementController::class, 'create'])->name('withdraw-management');
        Route::post('/reject-withdraw/{withdraw}', [WithdrawManagementController::class, 'rejectWithdraw'])->name('reject-withdraw');
        Route::get('/ticket-management', [TicketManagement::class, 'render'])->name('ticket-management');
    });

    Route::get('/success-payment', [InvoiceController::class, 'successPayment']);
    Route::get('/failed-payment', [InvoiceController::class, 'failedPayment']);

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


