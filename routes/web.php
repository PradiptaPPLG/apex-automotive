<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────
// PUBLIC ROUTES (no login required)
// ──────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth — Login flow
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/send-otp', [AuthController::class, 'sendOtp'])->name('auth.send-otp');
    Route::get('/login/verify', [AuthController::class, 'showOtpForm'])->name('auth.otp.form');
    Route::post('/login/verify', [AuthController::class, 'verifyOtp'])->name('auth.verify-otp');

    // Google SSO Routes
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// Logout (must be authenticated)
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ──────────────────────────────────────────────
// AUTHENTICATED ROUTES
// ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Profile completion (new user must fill this before ordering)
    Route::get('/profile/complete', [AuthController::class, 'showProfileComplete'])->name('profile.complete');
    Route::post('/profile/complete', [AuthController::class, 'saveProfile'])->name('profile.save');
});
