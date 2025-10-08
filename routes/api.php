<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Auth\AuthController;



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth:api']);

Route::post('/email/verify', [AuthController::class, 'verifyEmail']);
Route::post('/email/verify/resend', [AuthController::class, 'resendVerifyEmail']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('posts/me', [PostController::class, 'myPosts']);
    Route::apiResource('posts', PostController::class);
    Route::resource('users', UserController::class)->middleware('admin');
});
