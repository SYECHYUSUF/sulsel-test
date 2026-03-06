<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriInformasiResource;
use App\Http\Resources\TahunInformasiResource;
use App\Models\KategoriInformasi;
use App\Models\MasterTahun;
use App\Models\MasterDomisili;
use App\Models\MasterPekerjaan;
use App\Models\AlasanPengajuan;
use App\Models\BentukInformasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class MasterDataController extends Controller
{
    /**
     * Menampilkan daftar tahun yang tersedia.
     */
    public function tahun(): JsonResponse
    {
        $data = Cache::remember('tahun_informasi', 3600, function () {
            return MasterTahun::select('waktu')
                ->orderBy('waktu', 'desc')
                ->get();
        });

        return response()->json(TahunInformasiResource::collection($data));
    }

    /**
     * Menampilkan daftar kategori informasi.
     */
    public function kategori(): JsonResponse
    {
        $data = Cache::remember('kategori_informasi', 3600, function () {
            return KategoriInformasi::select(['id_kat_info', 'nm_kat_info', 'slug'])->get();
        });

        return response()->json(KategoriInformasiResource::collection($data));
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