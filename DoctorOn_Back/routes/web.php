<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Auth::routes();

Route::group(['middleware' => 'guest'], function () {
    // LOGIN
    Route::get('/', [LoginController::class, 'login'])->name('login.form');
    Route::post('/login', [LoginController::class, 'logar'])->name('login');

    // REGISTER
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store'])->name('register');

    // RESET -> Envia para o email o link
    Route::get('/forget-password', [ResetPasswordController::class, 'request'])->name('password.request');
    Route::post('/forget-password', [ResetPasswordController::class, 'email'])->name('password.email');

    // RESETA A SENHA
    Route::get('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
    Route::post('/reset-update', [ResetPasswordController::class, 'update'])->name('password.update');
});


Route::group(['middleware' => 'auth'], function () {
    // ADMIN
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('profile', [AdminController::class, 'index'])->name('admin.index');

    // CONFIGURAÇÕES UNIDADES   
    Route::post('unit', [UnitController::class, 'store'])->name('unit.store');
    Route::post('address', [AddressController::class, 'store'])->name('address.store');
    Route::post('time', [TimeController::class, 'store'])->name('time.store');

    // USUÁRIOS
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    // TIPOS
    Route::get('types', [TypeController::class, 'index'])->name('types.index');
    Route::get('types/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('types', [TypeController::class, 'store'])->name('types.store');
    Route::get('types/{id}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::put('types/{id}', [TypeController::class, 'update'])->name('types.update');
    Route::delete('types/{id}/destroy', [TypeController::class, 'destroy'])->name('types.destroy');

    // MÉDICOS
    Route::get('doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::delete('doctors/{id}/destroy', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('doctor/{id}/{ative}', [DoctorController::class, 'activeDoctor'])->name('doctor.active');

    // ESPECIALIDADES
    Route::get('specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
    Route::get('specialties/create', [SpecialtyController::class, 'create'])->name('specialties.create');
    Route::post('specialties', [SpecialtyController::class, 'store'])->name('specialties.store');
    Route::get('specialties/{id}/edit', [SpecialtyController::class, 'edit'])->name('specialties.edit');
    Route::put('specialties/{id}', [SpecialtyController::class, 'update'])->name('specialties.update');
    Route::delete('specialties/{id}/destroy', [SpecialtyController::class, 'destroy'])->name('specialties.destroy');
});
