<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\SettingsController;

// Admin Authentication Routes (Public)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    });

    // Admin Protected Routes
    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/quick-access', [DashboardController::class, 'updateQuickAccess'])->name('quick-access.update');
<<<<<<< HEAD
=======
         Route::get('testimonials', [TestimonialController::class, 'index'])
        ->name('admin.testimonials.index');

    Route::patch('testimonials/{id}/visibility', [TestimonialController::class, 'toggleVisibility'])
        ->name('admin.testimonials.visibility');

    Route::delete('testimonials/{id}', [TestimonialController::class, 'destroy'])
        ->name('admin.testimonials.destroy');
>>>>>>> 0d46fbabf1eb6f7f94be51bbe166b890193439e6

        // Menu Management
        Route::resource('menus', MenuController::class);

        // Promo Management
        Route::resource('promos', PromoController::class);

        // Testimonials & Feedback
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::patch('testimonials/{id}/visibility', [TestimonialController::class, 'toggleVisibility'])->name('testimonials.visibility');
        Route::delete('testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // Settings (Location & Hours)
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
