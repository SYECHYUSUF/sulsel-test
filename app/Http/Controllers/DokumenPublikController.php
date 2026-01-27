<?php

namespace App\Http\Controllers;

use App\Models\DokumenPublik;
use Illuminate\Http\Request;

class DokumenPublikController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('query');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        // Join untuk mendapatkan nama kategori
        $results = DokumenPublik::join('tbl_kat_informasi', 'tbl_informasi.id_kat_info', '=', 'tbl_kat_informasi.id_kat_info')
            ->where('tbl_informasi.verify', 'y')
            ->where(function ($q) use ($query) {
                $q->where('tbl_informasi.judul', 'LIKE', "%{$query}%")
                    ->orWhere('tbl_informasi.ket', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get([
                'tbl_informasi.id_informasi',
                'tbl_informasi.judul',
                'tbl_informasi.ket',
                'tbl_kat_informasi.nm_kat_info'
            ]);

        return response()->json($results);
    }

    public function sertaMerta(Request $request)
    {
        $informasiData = DokumenPublik::where('id_kat_info', 22)
            ->where('verify', 'y')
            ->paginate(10);

        return view('pages.informasi-publik.serta-merta', compact('informasiData'));
    }

    public function setiapSaat(Request $request)
    {
        $informasiData = DokumenPublik::where('id_kat_info', 33)
            ->where('verify', 'y')
            ->paginate(10);

        return view('pages.informasi-publik.setiap-saat', compact('informasiData'));
    }

    public function berkala(Request $request)
    {
        $informasiData = DokumenPublik::where('id_kat_info', 103)
            ->where('verify', 'y')
            ->paginate(10);

        return view('pages.informasi-publik.berkala', compact('informasiData'));
    }

    public function dikecualikan(Request $request)
    {
        $informasiData = DokumenPublik::where('id_kat_info', 100)
            ->where('verify', 'y')
            ->paginate(10);

        return view('pages.informasi-publik.dikecualikan', compact('informasiData'));
    }

    public function show($id)
    {
        $informasi = DokumenPublik::with(['kategori', 'skpd'])->findOrFail($id);

        return view('pages.informasi-publik.detail', compact('informasi'));
    }
}

