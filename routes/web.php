<?php

use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────
// PUBLIC ROUTES (no login required)
// ──────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// Inquiry — VIP Viewing Request (works for guests & authenticated users)
Route::post('/inquire', [InquiryController::class, 'store'])->name('inquire.store');

// Auth — Login flow
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/qr', [AuthController::class, 'loginQr'])->name('login.qr');
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
// AUTHENTICATED ROUTES — Buyer Portal
// ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Profile completion (new user must fill this before ordering)
    Route::get('/profile/complete', [AuthController::class, 'showProfileComplete'])->name('profile.complete');
    Route::post('/profile/complete', [AuthController::class, 'saveProfile'])->name('profile.save');

    // VIP Buyer Portal
    Route::get('/portal', [PortalController::class, 'dashboard'])->name('portal.dashboard');
    Route::get('/portal/inquiry/{inquiry}', [PortalController::class, 'consultation'])->name('portal.consultation');
    Route::post('/portal/inquiry/{inquiry}/message', [ConsultationController::class, 'store'])->name('portal.message.store');
    Route::get('/portal/inquiry/{inquiry}/poll', [ConsultationController::class, 'poll'])->name('portal.message.poll');
    Route::post('/portal/inquiry/{inquiry}/sign-contract', [PortalController::class, 'signContract'])->name('portal.contract.sign');
    Route::get('/portal/inquiry/{inquiry}/download-contract', [PortalController::class, 'downloadContract'])->name('portal.contract.download');
    Route::get('/portal/inquiry/{inquiry}/tracking', [\App\Http\Controllers\DeliveryController::class, 'trackingPoll'])->name('portal.tracking');
});

// ──────────────────────────────────────────────
// DELIVERY DRIVER ROUTES (pradipta.endra4@smp.belajar.id)
// ──────────────────────────────────────────────
Route::middleware(['auth', 'delivery'])->prefix('delivery')->name('delivery.')->group(function () {
    Route::get('/', [\App\Http\Controllers\DeliveryController::class, 'portal'])->name('portal');
    Route::get('/{delivery}', [\App\Http\Controllers\DeliveryController::class, 'detail'])->name('detail');
    Route::post('/{delivery}/update-location', [\App\Http\Controllers\DeliveryController::class, 'updateLocation'])->name('update-location');
});

// ──────────────────────────────────────────────
// RM / ADMIN ROUTES
// ──────────────────────────────────────────────
Route::middleware(['auth', 'rm'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');

    Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::post('/inquiries/{inquiry}/message', [AdminInquiryController::class, 'sendMessage'])->name('inquiries.message');
    Route::get('/inquiries/{inquiry}/poll', [AdminInquiryController::class, 'poll'])->name('inquiries.poll');
    Route::get('/inquiries/{inquiry}/download-contract', [AdminInquiryController::class, 'downloadContract'])->name('inquiries.contract.download');
    Route::post('/inquiries/{inquiry}/verify-location', [AdminInquiryController::class, 'verifyLocation'])->name('inquiries.verify-location');
    Route::post('/inquiries/{inquiry}/reject-location', [AdminInquiryController::class, 'rejectLocation'])->name('inquiries.reject-location');
});

// ──────────────────────────────────────────────
// MANAGER ROUTES (pradiptaghensin@gmail.com)
// ──────────────────────────────────────────────
Route::middleware(['auth', 'manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Manager\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/preview', [\App\Http\Controllers\Manager\DashboardController::class, 'preview'])->name('preview');

    // Cars Management
    Route::resource('cars', \App\Http\Controllers\Manager\CarController::class)->except(['show']);

    // Team Management (Sales RM & Delivery Driver)
    Route::get('/team', [\App\Http\Controllers\Manager\TeamController::class, 'index'])->name('team.index');
    Route::get('/team/create', [\App\Http\Controllers\Manager\TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [\App\Http\Controllers\Manager\TeamController::class, 'store'])->name('team.store');
    Route::delete('/team/{user}', [\App\Http\Controllers\Manager\TeamController::class, 'destroy'])->name('team.destroy');
});
