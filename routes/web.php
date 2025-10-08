<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.store');

Route::get('email/verify', [AuthController::class, 'ViewEmailVerification'])->name('email.verify');
Route::post('email/verify', [AuthController::class, 'verifyEmailOtp'])->name('email.verify.store');
Route::post('email/verify/resend', [AuthController::class, 'resendEmailVerification'])->name('email.verify.resend');





Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('posts/me', [PostController::class, 'myPosts'])->name('posts.me');
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/test', function () {
    return view('emails.email-verification-otp');
});
