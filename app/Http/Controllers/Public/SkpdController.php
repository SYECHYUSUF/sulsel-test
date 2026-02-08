<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    /**
     * Menampilkan daftar seluruh SKPD.
     */
    public function index(Request $request): JsonResponse
    {
        $search = $request->input('search');

        $query = Skpd::orderBy('nm_skpd', 'asc');

        // Apply search filter if search term exists
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nm_skpd', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('website', 'like', '%' . $search . '%');
            });
        }

        $skpd = $query->paginate(12)->appends(['search' => $search]);

        return response()->json([
            'success' => true,
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menampilkan detail satu SKPD berdasarkan ID.
     */
    public function show($id): JsonResponse
    {
        $skpd = Skpd::where('id_skpd', $id)->first();

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Data SKPD tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data SKPD',
            'data'    => $skpd
        ], 200);
    }
}