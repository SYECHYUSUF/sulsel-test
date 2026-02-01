<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilPemprovController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::getByTipe('pemerintah');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Profil Pemerintah Sulawesi Selatan',
                'slug' => 'profil-pemprov',
                'tipe' => 'pemerintah',
                'deskripsi' => ''
            ]);
        }
        
        return view('admin.profil-pemprov.index', compact('profil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
            'foto_gubernur' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB max
            'foto_wakil' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'nm_profil' => $request->nm_profil,
            'slug' => 'profil-pemprov',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'pemerintah',
        ];

        $profil = Profil::where('tipe', 'pemerintah')->first();

        // Handle foto gubernur upload
        if ($request->hasFile('foto_gubernur')) {
            // Delete old file if exists
            if ($profil && $profil->foto_gubernur && \Storage::disk('public')->exists($profil->foto_gubernur)) {
                \Storage::disk('public')->delete($profil->foto_gubernur);
            }
            
            $file = $request->file('foto_gubernur');
            $filename = 'gubernur_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profil/pemerintah', $filename, 'public');
            $data['foto_gubernur'] = $path;
        }

        // Handle foto wakil upload
        if ($request->hasFile('foto_wakil')) {
            // Delete old file if exists
            if ($profil && $profil->foto_wakil && \Storage::disk('public')->exists($profil->foto_wakil)) {
                \Storage::disk('public')->delete($profil->foto_wakil);
            }
            
            $file = $request->file('foto_wakil');
            $filename = 'wakil_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profil/pemerintah', $filename, 'public');
            $data['foto_wakil'] = $path;
        }

        Profil::updateOrCreate(
            ['tipe' => 'pemerintah'],
            $data
        );

        return redirect()->route('admin.profil-pemprov.index')
            ->with('success', 'Profil Pemerintah Sulawesi Selatan berhasil diperbarui.');
    }
}
