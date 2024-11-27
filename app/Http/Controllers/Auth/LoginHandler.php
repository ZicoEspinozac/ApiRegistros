<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\Users\UserResource;

class LoginHandler extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response([
                    'message' => 'Credenciales inválidas'
                ], 401);
            }
        } catch (JWTException $exception) {
            return response([
                'message' => 'No se pudo crear el token'
            ], 500);
        }

        $user = JWTAuth::user();

        return response([
            'token' => $token,
            'user' => new UserResource($user)
        ], 200);
    }
}