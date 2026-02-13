<?php

namespace App\Http\Controllers;

use Albet\SanctumRefresh\Services\TokenIssuer;
use Illuminate\Http\Request;

class TokenController {
    public function refreshToken(Request $request) {
        $newToken = TokenIssuer::refreshToken($request->get('refresh-token', ''));

        if(!$newToken) {
            return response()->json([
                'error' => 'Refresh token not valid',
            ], 400);
        }

        return response()->json([
            'message' => 'New token created',
            'data' => $newToken->toArray(),
        ]);
    }
}