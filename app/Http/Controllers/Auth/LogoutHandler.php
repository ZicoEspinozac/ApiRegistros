<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutHandler extends Controller
{
    public function logout(Request $request)
    {
        try {
            $token = $request->bearerToken();
            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 400);
            }

            JWTAuth::setToken($token)->invalidate();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to log out, please try again.'], 500);
        }
    }
}