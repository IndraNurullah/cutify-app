<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminBookingController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');

// Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Booking dan pembayaran wajib login
Route::middleware('pelanggan')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/create', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])
        ->name('booking.cancel');

    Route::get('/booking/{booking}/pembayaran', [PembayaranController::class, 'show'])
        ->name('pembayaran.show');

    Route::post('/booking/{booking}/pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'authenticate'])
        ->name('login.authenticate');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

            Route::get('/bookings', [AdminBookingController::class, 'index'])
    ->name('bookings.index');

Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
    ->name('bookings.updateStatus');

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
    });
});