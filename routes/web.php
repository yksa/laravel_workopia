<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    $jobs = [];
    return view('jobs.index', [
        'title' => 'Available Jobs',
        'jobs' => $jobs
    ]);
})->name('jobs');

Route::get('/jobs/create', function () {
    return view('jobs.create');
})->name('jobs.create');
