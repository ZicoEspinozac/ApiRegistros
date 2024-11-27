<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-test-email', function () {
    Mail::raw('Este es un correo de prueba.', function ($message) {
        $message->to('test@example.com')
                ->subject('Correo de Prueba');
    });

    return 'Correo enviado';
});