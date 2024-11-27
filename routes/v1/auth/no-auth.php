<?php

use App\Http\Controllers\Vouchers\GetVouchersHandler;
use App\Http\Controllers\Vouchers\StoreVouchersHandler;
use App\Http\Controllers\Vouchers\DeleteVoucherHandler;
use App\Http\Controllers\Vouchers\GetTotalAmountsByCurrencyHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('vouchers')->group(function () {
    Route::get('/', GetVouchersHandler::class);
    Route::post('/', StoreVouchersHandler::class);
    Route::delete('/{id}', DeleteVoucherHandler::class);
    Route::get('/totals', GetTotalAmountsByCurrencyHandler::class); // Ruta para obtener los montos totales acumulados por moneda
});