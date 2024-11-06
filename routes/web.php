<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\LogRequest;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('jobs', JobController::class);

Route::get('register', [RegisterController::class, 'register'])->name('register')->middleware(LogRequest::class);
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware(LogRequest::class);
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
