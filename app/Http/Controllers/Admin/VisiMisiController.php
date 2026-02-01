<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        
        return view('admin.visi-misi.index', compact('profil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
        ]);

        Profil::updateOrCreate(
            ['tipe' => 'visi-misi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'visi-misi',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'visi-misi',
            ]
        );

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi Misi berhasil diperbarui.');
    }
}
