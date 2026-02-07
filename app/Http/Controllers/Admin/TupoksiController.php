<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TupoksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::getByTipe('tupoksi');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Tupoksi',
                'slug' => 'tupoksi',
                'tipe' => 'tupoksi',
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
        $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
        ]);

        $profil = Profil::updateOrCreate(
            ['tipe' => 'tupoksi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'tupoksi',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'tupoksi',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Tupoksi berhasil diperbarui.',
            'data'    => $profil
        ], 200);
    }
}