<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::getByTipe('visi-misi');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Visi Misi',
                'slug' => 'visi-misi',
                'tipe' => 'visi-misi',
                'deskripsi' => ''
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
        ]);

        $profil = Profil::updateOrCreate(
            ['tipe' => 'visi-misi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'visi-misi',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'visi-misi',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Visi Misi berhasil diperbarui.',
            'data'    => $profil
        ], 200);
    }
}