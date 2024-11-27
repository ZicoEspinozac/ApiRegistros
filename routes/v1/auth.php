<?php

use App\Http\Controllers\Vouchers\GetVouchersHandler;
use App\Http\Controllers\Vouchers\StoreVouchersHandler;
use App\Http\Controllers\Vouchers\DeleteVoucherHandler;
use App\Http\Controllers\Vouchers\GetTotalAmountsByCurrencyHandler;
use Illuminate\Support\Facades\Route;

Route::prefix('vouchers')->group(function () {
    Route::get('/', [GetVouchersHandler::class, '__invoke']);
    Route::post('/', [StoreVouchersHandler::class, '__invoke']);
    Route::delete('/{id}', [DeleteVoucherHandler::class, '__invoke']);
    Route::get('/totals', [GetTotalAmountsByCurrencyHandler::class, '__invoke']); // Ruta para obtener los montos totales acumulados por moneda
});