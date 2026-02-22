<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Albet\SanctumRefresh\Helpers;
use Albet\SanctumRefresh\Exceptions\SanctumRefreshException;
use Albet\SanctumRefresh\Models\RefreshToken;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, \Closure $next): Response {
        
    //     try {
    //         Helpers::getRefreshToken(
    //             $request->get('refresh_token', '') // adjust to your liking, either from Query Parameter, Body, or Header.
    //         );

    //         return $next($request);
    //     } catch (SanctumRefreshException $e) {
    //         // handle tags of SanctumRefreshException
    //         return response()->json([
    //             'error' => 'Refresh token invalid'
    //         ], 400);
    //     }
    // }

    public function handle(Request $request, Closure $next): Response {
        $tokenText = $request->get('refresh_token', '');
        
        // Pecah token secara manual
        $parts = explode('|', $tokenText);
        if (count($parts) < 2) {
            return response()->json(['error' => 'Format token tidak valid'], 400);
        }

        // Cari berdasarkan token_id (bukan id primary key)
        $refreshToken = RefreshToken::where('token_id', $parts[0])
            ->where('expires_at', '>=', now())
            ->where('token', hash('sha256', $parts[1]))
            ->first();

        if (!$refreshToken) {
            return response()->json(['error' => 'Refresh token invalid'], 400);
        }

        return $next($request);
    }
}
