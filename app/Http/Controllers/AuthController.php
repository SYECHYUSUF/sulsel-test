<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Albet\SanctumRefresh\Services\TokenIssuer;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = $request->user();

        // membuat access_token dan refresh_token
        $token = TokenIssuer::issue($user);

        $user->load(['skpd' => function($query) {
            $query->select('id_skpd', 'nm_skpd');
        }]);

        return response()->json([
            'token' => $token->toArray(),
            'user' => $user,
        ]);
    }
    
   public function logout(Request $request)
    {
        /** @var User $user */ 
        $user = $request->user();

        if ($user) {
            // Menghapus token yang sedang digunakan saja (Direkomendasikan)
            $user->currentAccessToken()->delete();

            return response()->json(['status' => 'success', 'message' => 'Logged out']);
        }

        return response()->json(['status' => 'error', 'message' => 'User not found'], 401);
    }
}