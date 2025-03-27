<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware(CheckRole::class)->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/edit-user/{id}', [UserController::class, 'edit'])->middleware(CheckRole::class)->name('edit.user');
Route::put('/update-user/{id}', [UserController::class, 'update'])->middleware(CheckRole::class)->name('update.user');
Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->middleware(CheckRole::class)->name('delete.user');




