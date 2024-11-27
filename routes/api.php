<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginHandler;
use App\Http\Controllers\Auth\LogoutHandler;
use App\Http\Controllers\Auth\SignUpHandler;

include_once 'v1/no-auth.php';

// Rutas de autenticación
Route::post('v1/users', [SignUpHandler::class, 'register']);
Route::post('v1/login', [LoginHandler::class, 'login']);
Route::post('v1/logout', [LogoutHandler::class, 'logout']);

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'v1'], function () {
    include_once 'v1/auth.php';
});