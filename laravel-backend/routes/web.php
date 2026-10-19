<?php

use App\Http\Controllers\SampleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', [SampleController::class, 'index']);
Route::get('/read', [SampleController::class, 'read']);
Route::get('/greet/{name}', [SampleController::class, 'greet']);
