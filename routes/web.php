<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('user-register', [AuthController::class, 'register'])->name('user.register');
Route::post('user-login', [AuthController::class, 'login'])->name('user.login');
Route::get('home', [ExpenseController::class, 'home'])->name('user.home');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
