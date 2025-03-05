<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\UserCatalogController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return Auth::check() && Auth::user()->hasRole('user') ? redirect()->route('welcome') : view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('catalogs', \App\Http\Controllers\CatalogController::class)->middleware('auth');

Route::get('payment', [App\Http\Controllers\PaymentController::class, 'admin'])->name('payment.admin');
Route::patch('payment/{payment_id}/approve', [App\Http\Controllers\PaymentController::class, 'paymentApprove'])->name('payment.approve');
Route::patch('payment/{payment_id}/reject', [App\Http\Controllers\PaymentController::class, 'paymentReject'])->name('payment.reject');

Route::get('/user/catalog', [App\Http\Controllers\UserCatalogController::class, 'index'])->name('user-catalog');
Route::post('/order/store', [App\Http\Controllers\UserCatalogController::class, 'store'])->name('order.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('order.payment');
    Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.process');
});


require __DIR__.'/auth.php';
