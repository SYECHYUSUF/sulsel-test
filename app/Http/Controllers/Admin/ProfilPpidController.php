<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProfilPpidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::getByTipe('profil-ppid');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Profil PPID',
                'slug' => 'profil-ppid',
                'tipe' => 'profil-ppid',
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
            ['tipe' => 'profil-ppid'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'profil-ppid',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'profil-ppid',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Profil PPID berhasil diperbarui.',
            'data'    => $profil
        ], 200);
    }
}