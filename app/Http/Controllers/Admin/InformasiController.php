<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\KategoriInformasi;
use App\Models\Skpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Informasi::with(['kategori', 'skpd']); // Eager loading with SKPD

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
        $kategoriList = KategoriInformasi::where('is_active', 1)->get();
        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        return view('admin.informasi.index', compact('informasi', 'kategoriList', 'skpdList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        $kategoriList = KategoriInformasi::where('is_active', 1)->get();

        return view('admin.informasi.create', compact('skpdList', 'kategoriList'));
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
            'verify' => 'required|in:y,n,t',
        ]);

        $data = $request->all();

        // Handle File Upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('informasi/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        Informasi::create($data);

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Dokumen informasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informasi = Informasi::findOrFail($id);
        $user = Auth::user();

        // Security check for OPD
        if ($user->hasRole('opd') && $informasi->id_skpd !== $user->id_skpd) {
            abort(403);
        }

        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        $kategoriList = KategoriInformasi::where('is_active', 1)->get();

        return view('admin.informasi.edit', compact('informasi', 'skpdList', 'kategoriList'));
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

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Dokumen informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
            Storage::disk('public')->delete($informasi->file);
        }

        $informasi->delete();

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', 'Dokumen informasi berhasil dihapus.');
    }

    /**
     * Bulk delete informasi
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tbl_informasi,id_informasi',
        ]);

        $user = Auth::user();
        $query = Informasi::whereIn('id_informasi', $request->ids);

        // Security check for OPD users
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        $informasiList = $query->get();

        if ($informasiList->isEmpty()) {
            return redirect()->route('admin.informasi-publik.index')
                ->with('error', 'Tidak ada data yang dapat dihapus.');
        }

        // Delete files and records
        foreach ($informasiList as $informasi) {
            if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
                Storage::disk('public')->delete($informasi->file);
            }
            $informasi->delete();
        }

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', count($informasiList) . ' dokumen berhasil dihapus.');
    }

    /**
     * Bulk update verification status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tbl_informasi,id_informasi',
            'verify' => 'required|in:y,n,t',
        ]);

        $user = Auth::user();
        $query = Informasi::whereIn('id_informasi', $request->ids);

        // Security check for OPD users
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        $count = $query->update(['verify' => $request->verify]);

        $statusText = match ($request->verify) {
            'y' => 'Terverifikasi',
            'n' => 'Pending',
            't' => 'Ditolak',
        };

        return redirect()->route('admin.informasi-publik.index')
            ->with('success', $count . ' dokumen berhasil diubah menjadi ' . $statusText . '.');
    }
}
