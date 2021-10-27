<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\UserController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'authenticate']);

Route::post('reset', [ForgotPasswordController::class, 'forgotReset']);


Route::group(['middleware' => ['jwt.verify']], function () {
    // User
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('profile/update/{user}',  [UserController::class, 'update']);

    // Units
    Route::get('units', [UnitsController::class, 'index']);
    Route::get('units/{id}', [UnitsController::class, 'show']);

    // Doctor
    Route::get('doctors/{specialty}', [DoctorController::class, 'searchDoctor']);

    // specialties
    Route::get('specialties', [SpecialtyController::class, 'index']);
});
