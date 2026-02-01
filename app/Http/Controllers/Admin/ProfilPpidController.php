<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilPpidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        
        return view('admin.profil-ppid.index', compact('profil'));
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
            ['tipe' => 'profil-ppid'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'profil-ppid',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'profil-ppid',
            ]
        );

        return redirect()->route('admin.profil-ppid.index')
            ->with('success', 'Profil PPID berhasil diperbarui.');
    }
}
