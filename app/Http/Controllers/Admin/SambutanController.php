<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::getByTipe('sambutan');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Sambutan',
                'slug' => 'sambutan',
                'tipe' => 'sambutan',
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
            'foto_kepala' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'nm_profil' => $request->nm_profil,
            'slug' => 'sambutan',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'sambutan',
        ];

        if ($request->hasFile('foto_kepala')) {
            $profil = Profil::where('tipe', 'sambutan')->first();
            
            if ($profil && $profil->foto_kepala && Storage::disk('public')->exists($profil->foto_kepala)) {
                Storage::disk('public')->delete($profil->foto_kepala);
            }
            
            $file = $request->file('foto_kepala');
            $filename = 'kepala_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profil/sambutan', $filename, 'public');
            $data['foto_kepala'] = $path;
        }

        $item = Profil::updateOrCreate(
            ['tipe' => 'sambutan'],
            $data
        );

        return response()->json([
            'success' => true,
            'message' => 'Sambutan berhasil diperbarui.',
            'data'    => $item
        ], 200);
    }
}