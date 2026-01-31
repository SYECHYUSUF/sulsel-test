<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;

class MaklumatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profil = Profil::getByTipe('maklumat');
        
        if (!$profil) {
            $profil = new Profil([
                'nm_profil' => 'Maklumat Pelayanan',
                'slug' => 'maklumat-pelayanan',
                'tipe' => 'maklumat',
                'deskripsi' => ''
            ]);
        }
        
        return view('admin.maklumat.index', compact('profil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
            'file_banner' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
        ]);

        $data = [
            'nm_profil' => $request->nm_profil,
            'slug' => 'maklumat-pelayanan',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'maklumat',
        ];

        // Handle file upload
        if ($request->hasFile('file_banner')) {
            $profil = Profil::where('tipe', 'maklumat')->first();
            
            // Delete old file if exists
            if ($profil && $profil->file_banner && \Storage::disk('public')->exists($profil->file_banner)) {
                \Storage::disk('public')->delete($profil->file_banner);
            }
            
            $file = $request->file('file_banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profil/maklumat', $filename, 'public');
            $data['file_banner'] = $path;
        }

        Profil::updateOrCreate(
            ['tipe' => 'maklumat'],
            $data
        );

        return redirect()->route('admin.maklumat.index')
            ->with('success', 'Maklumat Pelayanan berhasil diperbarui.');
    }
}
