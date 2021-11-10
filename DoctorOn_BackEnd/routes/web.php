<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store'])->name('login.store');

Route::get('reset', [ForgotPasswordController::class, 'index'])->name('reset.index');
Route::post('reset', [ForgotPasswordController::class, 'store'])->name('reset.store');

Route::middleware(['auth'])->group(function () {

    // Home
    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('doctor/{id}/{ative}', [DoctorController::class, 'activeDoctor'])->name('doctor.active');

    // Cadastro
    Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('doctor', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user', [UserController::class, 'store'])->name('user.store');

    // Listas
    Route::get('doctors', [DoctorController::class, 'list'])->name('doctor.list.index');
    Route::delete('doctors/{id}', [DoctorController::class, 'destroy'])->name('doctor.list.destroy');

    Route::get('users', [UserController::class, 'list'])->name('user.list.index');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('user.list.destroy');

    Route::get('specialty', [SpecialtyController::class, 'indexWEB'])->name('specialty.index');
    Route::post('specialty', [SpecialtyController::class, 'store'])->name('specialty.store');


    Route::get('sobre', [HomeController::class, 'sobre'])->name('sobre.index');
    Route::get('contato', [HomeController::class, 'contato'])->name('contato.index');
    Route::get('logout', function () {
        Auth::logout(Auth::user());
        return view('login')->with('msg', 'Usuário deslogado com sucesso!');
    })->name('logout');
});
