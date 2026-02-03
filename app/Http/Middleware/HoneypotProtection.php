<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoneypotProtection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if honeypot field is filled (bots usually fill all fields)
        // The 'website' field is a hidden decoy field
        if ($request->filled('website')) {
            // Log the bot attempt for security monitoring
            \Log::warning('Honeypot triggered', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'honeypot_value' => $request->input('website'),
            ]);
            
            // Return a fake success response to confuse the bot
            // Don't tell them they've been caught
            return redirect()->back()->with('success', 'Form berhasil dikirim.');
        }
        
        // Check for suspiciously fast form submission (< 3 seconds)
        // Bots typically submit instantly
        if ($request->has('_form_timestamp')) {
            $timestamp = (int) $request->input('_form_timestamp');
            $currentTime = time();
            
            if (($currentTime - $timestamp) < 3) {
                \Log::warning('Fast form submission detected (possible bot)', [
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'submission_time' => ($currentTime - $timestamp) . ' seconds',
                ]);
                
                // Silently reject by returning fake success
                return redirect()->back()->with('success', 'Form berhasil dikirim.');
            }
        }
        
        return $next($request);
    }
}
