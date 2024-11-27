<?php

use App\Http\Controllers\Auth\LoginHandler;
use App\Http\Controllers\Auth\LogoutHandler;
use App\Http\Controllers\Auth\SignUpHandler;
use Illuminate\Support\Facades\Route;

// Rutas de autenticación sin protección
Route::post('/users', [SignUpHandler::class, 'register']);
Route::post('/login', [LoginHandler::class, 'login']);
Route::post('/logout', [LogoutHandler::class, 'logout']);