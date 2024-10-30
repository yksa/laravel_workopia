<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
