<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['clerk'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});