<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        
        $credentials = [
            'email' => $email,
            'password' => $password
        ];
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'acces_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60 *60
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function refresh()
    {
        return response()->json([
            'acces_token' => Auth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => 60 * 60
        ]);
    }

    public function data()
    {
        return response()->json(Auth::user());
    }
}
