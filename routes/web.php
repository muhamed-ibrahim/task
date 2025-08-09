<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\Auth\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('register', [AuthController::class, 'viewRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::get('login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.store');




Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('posts/me', [PostController::class, 'myPosts'])->name('posts.me');
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class)->middleware('admin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
