<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store'])->name('login.store');

Route::get('reset', [ForgotPasswordController::class, 'index'])->name('reset.index');
Route::post('reset', [ForgotPasswordController::class, 'store'])->name('reset.store');


Route::middleware(['auth'])->group(function () {

    Route::get('logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    Route::get('home', [HomeController::class, 'index'])->name('home.index');

    Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('doctor', [DoctorController::class, 'store'])->name('doctor.store');

    Route::get('sobre', [HomeController::class, 'sobre'])->name('sobre.index');
    Route::get('contato', [HomeController::class, 'contato'])->name('contato.index');
});
