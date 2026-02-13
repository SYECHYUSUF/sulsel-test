<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Albet\SanctumRefresh\Helpers;
use Albet\SanctumRefresh\Exceptions\SanctumRefreshException;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response {
        
        try {
            Helpers::getRefreshToken(
                $request->get('refresh_token', '') // adjust to your liking, either from Query Parameter, Body, or Header.
            );

            return $next($request);
        } catch (SanctumRefreshException $e) {
            // handle tags of SanctumRefreshException
            return response()->json([
                'error' => 'Refresh token invalid'
            ], 400);
        }
    }
}
