<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitors
{
    public function handle($request, Closure $next)
    {
        // Cek apakah sesi 'has_visited' sudah ada
        if (!session()->has('has_visited')) {
            // Mencatat pengunjung berdasarkan hari (Daily Visitor)
            $today = Carbon::today();
            
            // Cari data pengunjung hari ini, jika tidak ada maka buat baru
            $visitor = Visitor::firstOrCreate(
                ['created_at' => $today],
                ['count' => 0]
            );

            // Increment jumlah kunjungan secara efisien
            $visitor->increment('count');

            // Tandai dalam sesi bahwa user ini sudah dihitung
            session(['has_visited' => true]);
        }

        return $next($request);
    }
}