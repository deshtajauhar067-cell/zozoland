<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TestimonialController;

// Include admin routes
require __DIR__.'/admin.php';

Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/menu', [FrontController::class, 'menu'])->name('menu');
Route::get('/promo', [FrontController::class, 'promo'])->name('promo');
Route::get('/location', [FrontController::class, 'location'])->name('location');
Route::get('/testimonials', [FrontController::class, 'testimonials'])->name('testimonials');
Route::get('/about', function () {
    return view('about');
});


Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');



