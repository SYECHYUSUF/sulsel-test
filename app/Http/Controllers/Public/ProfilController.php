<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class ProfilController extends Controller
{
    /**
     * Get PPID Profile
     */
    public function ppid(): JsonResponse
    {
        $profil = Profil::where('tipe', 'profil-ppid')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }

    /**
     * Get Government Profile (Pemprov)
     */
    public function pemprov(): JsonResponse
    {
        $profil = Profil::where('tipe', 'pemerintah')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }

    /**
     * Get Visi Misi
     */
    public function visiMisi(): JsonResponse
    {
        $profil = Profil::where('tipe', 'visi-misi')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }

    /**
     * Get Tupoksi
     */
    public function tupoksi(): JsonResponse
    {
        $profil = Profil::where('tipe', 'tupoksi')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }

    /**
     * Get Struktur Organisasi
     */
    public function strukturOrganisasi(): JsonResponse
    {
        $path = Setting::where('key', 'struktur_organisasi_path')->value('value');
        return response()->json(['success' => true, 'data' => ['struktur_organisasi_path' => $path]]);
    }

    /**
     * Get Sambutan
     */
    public function sambutan(): JsonResponse
    {
        $profil = Profil::where('tipe', 'sambutan')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }

    /**
     * Get Maklumat
     */
    public function maklumat(): JsonResponse
    {
        $profil = Profil::where('tipe', 'maklumat')->first();
        return response()->json(['success' => true, 'data' => $profil]);
    }
}
