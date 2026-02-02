<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriInformasi;
use App\Models\MasterTahun;
use App\Models\MasterDomisili;
use App\Models\MasterPekerjaan;
use App\Models\AlasanPengajuan;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    /**
     * Display the unified master data management page
     */
    public function index()
    {
        $kategoris = KategoriInformasi::orderBy('nm_kat_info')->get();
        $tahuns = MasterTahun::orderBy('waktu', 'desc')->get();
        $domisilis = MasterDomisili::orderBy('nama_daerah')->get();
        $pekerjaans = MasterPekerjaan::orderBy('nama_pekerjaan')->get();
        $alasanPengajuans = AlasanPengajuan::orderBy('alasan')->get();

        return view('admin.master-data.index', compact('kategoris', 'tahuns', 'domisilis', 'pekerjaans', 'alasanPengajuans'));
    }

    /**
     * Store Kategori Informasi
     */
    public function storeKategori(Request $request)
    {
        $validated = $request->validate([
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        $kategori = KategoriInformasi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Informasi berhasil ditambahkan.',
            'data' => $kategori
        ]);
    }

    /**
     * Update Kategori Informasi
     */
    public function updateKategori(Request $request, $id)
    {
        $kategori = KategoriInformasi::findOrFail($id);

        $validated = $request->validate([
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        $kategori->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategori Informasi berhasil diperbarui.',
            'data' => $kategori
        ]);
    }

    // Unified Master Data Management Controller
    // CRUD operations are handled by their respective controllers
}
