<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class TupoksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        
        return view('admin.tupoksi.index', compact('profil'));
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
            ['tipe' => 'tupoksi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'tupoksi',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'tupoksi',
            ]
        );

        return redirect()->route('admin.tupoksi.index')
            ->with('success', 'Tupoksi berhasil diperbarui.');
    }
}
