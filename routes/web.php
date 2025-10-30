<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [DashboardController::class, 'index'])->name('city.index');
Route::get('/city', [CityController::class, 'index'])->name('city.index');
Route::resource('suppliers', SupplierController::class);
Route::resource('bills', BillController::class);

// web.php
Route::prefix('bills/{bill_number}')->group(function() {
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
});
