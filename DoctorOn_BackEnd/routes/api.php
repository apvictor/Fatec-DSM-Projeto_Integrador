<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\UserController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'authenticate']);

Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);



Route::group(['middleware' => ['jwt.verify']], function () {
    // User
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('profile/update/{user}',  [UserController::class, 'update']);


    // Unitis
    Route::get('units', [UnitsController::class, 'index']);


    // Doctor
    Route::get('doctors/', [DoctorController::class, 'searchDoctor']);


    // specialties
    Route::get('specialties', [SpecialtyController::class, 'index']);


    // Produts
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/show/{id}', [ProductController::class, 'show']);
    Route::post('products/store', [ProductController::class, 'store']);
    Route::post('products/update/{product}',  [ProductController::class, 'update']);
    Route::delete('products/delete/{product}',  [ProductController::class, 'destroy']);
});
