<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/test', function () {
    return response()->json(['message' => 'API jalan coy']);
});

// REGISTER
Route::post('/register-seeker', [AuthController::class, 'registerSeeker']);
Route::post('/register-company', [AuthController::class, 'registerCompany']);

// LOGIN
Route::post('/login-seeker', [AuthController::class, 'loginSeeker']);
Route::post('/login-company', [AuthController::class, 'loginCompany']);
