<?php

namespace App\Http\Controllers;

use Albet\SanctumRefresh\Models\RefreshToken;
use Albet\SanctumRefresh\Services\TokenIssuer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TokenController {
    public function refreshToken(Request $request) {
        try {
            $tokenText = $request->get('refresh_token', '');
            $parts = explode('|', $tokenText);

            // Cari token secara manual menggunakan token_id
            $token = RefreshToken::with('accessToken')
                ->where('token_id', $parts[0])
                ->where('expires_at', '>=', now())
                ->where('token', hash('sha256', $parts[1]))
                ->first();

            if (!$token || !$token->accessToken) {
                return response()->json(['error' => 'Refresh token not valid'], 400);
            }

            // Lanjutkan proses regenerasi secara manual atau gunakan user dari accessToken
            $user = $token->accessToken->tokenable;
            $newToken = TokenIssuer::issue($user);

            // Hapus Refresh Token terlebih dahulu (Data Anak)
            $token->delete();

            // Baru kemudian hapus Access Token (Data Induk)
            if ($token->accessToken) {
                $token->accessToken->delete();
            }

            return response()->json([
                'message' => 'New token created',
                'data' => $newToken->toArray(),
                'user' => $user
            ]);
        } catch (\Exception $e) {
            // Log detail error untuk keperluan debugging backend
            Log::error('Refresh Token Exception: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat memproses token'
            ], 500);
        }
    }
}