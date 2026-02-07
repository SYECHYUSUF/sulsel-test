<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $skpd = Skpd::all(); //

        return response()->json([
            'success' => true,
            'data'    => $skpd
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([ //
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|url|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'tupoksi'   => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        if ($request->hasFile('logo')) { //
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo-skpd', $filename, 'public');
            $validated['logo'] = $filename;
        }

        Skpd::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil ditambahkan.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skpd $skpd): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $skpd //
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skpd $skpd): JsonResponse
    {
        $validated = $request->validate([ //
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|url|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'tupoksi'   => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        if ($request->hasFile('logo')) { //
            // Hapus logo lama jika ada
            if ($skpd->logo && Storage::disk('public')->exists('logo-skpd/' . $skpd->logo)) {
                Storage::disk('public')->delete('logo-skpd/' . $skpd->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo-skpd', $filename, 'public');
            $validated['logo'] = $filename;
        }

        $skpd->update($validated); //

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil diperbarui.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skpd $skpd): JsonResponse
    {
        if ($skpd->logo && Storage::disk('public')->exists('logo-skpd/' . $skpd->logo)) {
            Storage::disk('public')->delete('logo-skpd/' . $skpd->logo);
        }

        $skpd->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil dihapus.'
        ], 200);
    }
}