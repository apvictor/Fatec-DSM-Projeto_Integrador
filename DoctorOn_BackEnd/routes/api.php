<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [LoginController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/show/{id}', [ProductController::class, 'show']);
    Route::post('products/store', [ProductController::class, 'store']);
    Route::post('products/update/{product}',  [ProductController::class, 'update']);
    Route::delete('products/delete/{product}',  [ProductController::class, 'destroy']);
});
