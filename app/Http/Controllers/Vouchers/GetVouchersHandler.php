<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Requests\Vouchers\GetVouchersRequest;
use App\Http\Resources\Vouchers\VoucherResource;
use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class GetVouchersHandler
{
    public function __construct(private readonly VoucherService $voucherService)
    {
    }

    public function __invoke(GetVouchersRequest $request): JsonResponse
    {
        $user = $request->user();
        $query = Voucher::where('user_id', $user->id);

        if ($request->has('serie')) {
            $query->where('serie', $request->serie);
        }
        if ($request->has('numero')) {
            $query->where('numero', $request->numero);
        }
        if ($request->has('tipo_comprobante')) {
            $query->where('tipo_comprobante', $request->tipo_comprobante);
        }
        if ($request->has('moneda')) {
            $query->where('moneda', $request->moneda);
        }
        if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
            $query->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->has('page') && $request->has('paginate')) {
            $vouchers = $query->paginate($request->paginate);
        } else {
            $vouchers = $query->get();
        }
        
        return response()->json($vouchers);
    }
}