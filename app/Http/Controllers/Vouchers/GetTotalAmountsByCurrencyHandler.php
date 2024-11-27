<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetTotalAmountsByCurrencyHandler extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $totals = Voucher::where('user_id', $user->id)
            ->selectRaw('moneda, SUM(total_amount) as total')
            ->groupBy('moneda')
            ->get();

        return response()->json($totals);
    }
}