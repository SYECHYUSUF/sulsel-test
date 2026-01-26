<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skpd = Skpd::all();
        return view('admin.skpd.index', compact('skpd'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skpd.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skpd $skpd)
    {
        return view('admin.skpd.show', compact('skpd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skpd $skpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skpd $skpd)
    {
        $validated = $request->validate([
            'nm_skpd' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:150',
            'no_tlp' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'kadis' => 'nullable|string|max:200',
            'sek' => 'nullable|string|max:200',
            'visimisi' => 'nullable|string',
            'tupoksi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis' => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        // Handle Upload Gambar
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo-skpd', $filename, 'public');
            $validated['logo'] = $filename;
        }

        $skpd->update($validated);

        return redirect()->route('admin.skpd.show', $skpd)->with('success', 'Data SKPD berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpd $skpd)
    {
        //
    }
}
