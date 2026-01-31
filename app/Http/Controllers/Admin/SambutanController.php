<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        
        return view('admin.sambutan.index', compact('profil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
            'foto_kepala' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // 5MB max
        ]);

        $data = [
            'nm_profil' => $request->nm_profil,
            'slug' => 'sambutan',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'sambutan',
        ];

        // Handle foto kepala upload
        if ($request->hasFile('foto_kepala')) {
            $profil = Profil::where('tipe', 'sambutan')->first();
            
            // Delete old file if exists
            if ($profil && $profil->foto_kepala && \Storage::disk('public')->exists($profil->foto_kepala)) {
                \Storage::disk('public')->delete($profil->foto_kepala);
            }
            
            $file = $request->file('foto_kepala');
            $filename = 'kepala_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profil/sambutan', $filename, 'public');
            $data['foto_kepala'] = $path;
        }

        Profil::updateOrCreate(
            ['tipe' => 'sambutan'],
            $data
        );

        return redirect()->route('admin.sambutan.index')
            ->with('success', 'Sambutan berhasil diperbarui.');
    }
}
