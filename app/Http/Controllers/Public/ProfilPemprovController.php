<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;

class ProfilPemprovController extends Controller
{
    /**
     * Menampilkan profil Pemerintah untuk konsumsi publik.
     */
    public function index(): JsonResponse
    {
        // Mengambil data profil pemerintah (Gubernur & Wakil) 
        $profil = Profil::where('tipe', 'pemerintah')->first();

        return response()->json([
            'data'    => $profil
        ], 200);
    }
}