<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Jobs\ProcessVoucher;
use Exception;
use Illuminate\Http\JsonResponse;

class StoreVouchersHandler extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $xmlFiles = $request->file('files');

            if (!is_array($xmlFiles)) {
                $xmlFiles = [$xmlFiles];
            }

            $user = Auth::user();
            foreach ($xmlFiles as $xmlFile) {
                $xmlContent = file_get_contents($xmlFile->getRealPath());

                // Despachar el job para procesar el comprobante en segundo plano
                ProcessVoucher::dispatch($xmlContent, $user);
            }

            return response()->json(['message' => 'Comprobantes en proceso'], 202);
        } catch (Exception $exception) {
            Log::error('Error al procesar los comprobantes: ' . $exception->getMessage());
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}