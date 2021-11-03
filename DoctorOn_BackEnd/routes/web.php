<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;

Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
Route::post('doctor', [DoctorController::class, 'store'])->name('doctor.store');


Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::get('sobre', [HomeController::class, 'sobre'])->name('sobre.index');
