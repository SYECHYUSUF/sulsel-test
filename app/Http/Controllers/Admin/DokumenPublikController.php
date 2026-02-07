<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\Informasi;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenPublikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = DokumenPublik::with(['kategori', 'skpd']); // Eager loading with SKPD

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        // Search filter
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('id_kat_info')) {
            $query->where('id_kat_info', $request->id_kat_info);
        }

        // SKPD filter
        if ($request->filled('id_skpd') && !$user->hasRole('opd')) {
            $query->where('id_skpd', $request->id_skpd);
        }

        // Verification status filter
        if ($request->filled('verify')) {
            $query->where('verify', $request->verify);
        }

        // Date range filter
        if ($request->filled('start_date')) {
            $query->whereDate('tgl_upload', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tgl_upload', '<=', $request->end_date);
        }

        // Sort options
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest('tgl_upload');
                break;
            case 'title_asc':
                $query->orderBy('judul', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('judul', 'desc');
                break;
            default: // newest
                $query->latest('tgl_upload');
                break;
        }

        $informasi = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $informasi
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kat_info' => 'required',
            'id_skpd' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
            'ket' => 'required',
            'verify' => 'nullable|in:y,n,t',
        ]);

        $data = $request->all();

        // Set default value 'n' jika input 'verify' tidak ada di request
        $data['verify'] = $request->input('verify', 'n');

        // Handle File Upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('informasi/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        $informasi = Informasi::create($data);

        // Notify Admins if created by OPD
        if (Auth::user()->hasRole('opd')) {
            $admins = User::whereHasRole('admin')->get();
            foreach ($admins as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Dokumen Publik Baru',
                    'message' => 'OPD ' . Auth::user()->skpd->nm_skpd . ' telah mengunggah dokumen baru: ' . $informasi->judul,
                    'url' => route('admin.dokumen-publik.show', $informasi->id_informasi),
                    'notifiable_id' => $informasi->id_informasi,
                    'notifiable_type' => get_class($informasi),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil ditambahkan.',
            'data' => $informasi
        ], 200);
    }

    public function show(string $id)
    {
        $informasi = DokumenPublik::with(['kategori', 'skpd'])->findOrFail($id);
        $user = Auth::user();

        // Security check for OPD
        if ($user->hasRole('opd') && $informasi->id_skpd !== $user->id_skpd) {
            abort(403);
        }

        return response()->json([
            'success' => true,
            'data' => $informasi
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informasi = DokumenPublik::findOrFail($id);
        $user = Auth::user();

        // Security check for OPD
        if ($user->hasRole('opd') && $informasi->id_skpd !== $user->id_skpd) {
            abort(403);
        }

        return response()->json([
            'success' => true,
            'data' => $informasi
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $informasi = Informasi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'id_kat_info' => 'required',
            'id_skpd' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
            'ket' => 'required',
            'verify' => 'required|in:y,n,t',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Delete old file
            if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
                Storage::disk('public')->delete($informasi->file);
            }

            $file = $request->file('file');
            $path = $file->store('informasi/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        $informasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil diperbarui.',
            'data' => $informasi
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = DokumenPublik::findOrFail($id);

        if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
            Storage::disk('public')->delete($informasi->file);
        }

        $informasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil dihapus.',
        ], 200);
    }
}
