<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KategoriInformasi;
use App\Models\MasterTahun;
use App\Models\MasterDomisili;
use App\Models\MasterPekerjaan;
use App\Models\AlasanPengajuan;
use App\Models\BentukInformasi;
use Illuminate\Http\JsonResponse;

class MasterDataController extends Controller
{
    /**
     * Menampilkan daftar tahun yang tersedia.
     */
    public function tahun(): JsonResponse
    {
        $data = MasterTahun::select('waktu')
            ->orderBy('waktu', 'desc')
            ->get();

        return response()->json(['data' => $data], 200);
    }

    /**
     * Menampilkan daftar kategori informasi.
     */
    public function kategori(): JsonResponse
    {
        $data = KategoriInformasi::select(['nm_kat_info', 'slug'])
            ->get();

        return response()->json(['data' => $data]);
    }

    /**
     * Menampilkan daftar domisili yang aktif.
     */
    public function domisili(): JsonResponse
    {
        $data = MasterDomisili::active()
            ->select(['id', 'nama_daerah', 'provinsi'])
            ->orderBy('nama_daerah', 'asc')
            ->get();

        return response()->json(['data' => $data], 200);
    }

    /**
     * Menampilkan daftar pekerjaan yang aktif.
     */
    public function pekerjaan(): JsonResponse
    {
        $data = MasterPekerjaan::active()
            ->select(['id', 'nama_pekerjaan'])
            ->orderBy('nama_pekerjaan', 'asc')
            ->get();

        return response()->json(['data' => $data], 200);
    }

    /**
     * Menampilkan daftar alasan pengajuan.
     */
    public function alasanPengajuan(): JsonResponse
    {
        $data = AlasanPengajuan::select(['id', 'alasan'])
            ->get();

        return response()->json(['data' => $data], 200);
    }

    /**
     * Menampilkan daftar bentuk informasi.
     */
    public function bentukInformasi(): JsonResponse
    {
        $data = BentukInformasi::select(['id', 'judul'])
            ->get();

        return response()->json(['data' => $data], 200);
    }
}