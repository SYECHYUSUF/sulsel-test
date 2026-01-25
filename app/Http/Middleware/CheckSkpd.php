<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSkpd
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Izinkan jika user adalah Super Admin 
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // Ambil resource dari parameter rute (misal: /admin/berita/{berita})
        // Laravel otomatis mencoba memetakan model jika menggunakan Resource Controller
        $resource = $request->route()->parameter('berita') 
                 ?? $request->route()->parameter('data-skpd')
                 ?? $request->route()->parameter('permohonan_informasi');

        // Lakukan validasi jika resource ada dan memiliki kolom id_skpd
        if ($resource && isset($resource->id_skpd)) {
            if ($user->id_skpd !== $resource->id_skpd) {
                abort(403, 'Anda tidak memiliki akses ke data SKPD lain.');
            }
        }

        return $next($request);
    }
}