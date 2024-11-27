<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DeleteVoucherHandler extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $user = Auth::user();
        $voucher = Voucher::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $voucher->delete();

        return response()->json(['message' => 'Comprobante eliminado correctamente']);
    }
}