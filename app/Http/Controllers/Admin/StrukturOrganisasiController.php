<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.struktur-organisasi.index', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'struktur_organisasi' => 'nullable|mimes:pdf|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('struktur_organisasi')) {
            $file = $request->file('struktur_organisasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Store in storage/app/public/struktur_organisasi
            $path = $file->storeAs('struktur_organisasi', $filename, 'public');

            // Update or create setting
            \App\Models\Setting::updateOrCreate(
                ['key' => 'struktur_organisasi_path'],
                ['value' => 'storage/' . $path]
            );
        }

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Struktur Organisasi berhasil diperbarui.');
    }
}
