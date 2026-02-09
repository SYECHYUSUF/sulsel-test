<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\JsonResponse;

class SosmedController extends Controller
{
    /**
     * Menampilkan daftar media sosial berdasarkan urutan.
     */
    public function index(): JsonResponse
    {
        $sosmeds = Sosmed::orderBy('urutan')->get();

        return response()->json([
            'data'    => $sosmeds
        ], 200);
    }

}