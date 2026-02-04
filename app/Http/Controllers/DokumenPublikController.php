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
        $search = $request->query('search');
        $informasiData = DokumenPublik::where('id_kat_info', 22)
            ->where('verify', 'y')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('ket', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.serta-merta', compact('informasiData', 'search'));
    }

    public function setiapSaat(Request $request)
    {
        $search = $request->query('search');
        $informasiData = DokumenPublik::where('id_kat_info', 33)
            ->where('verify', 'y')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('ket', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.setiap-saat', compact('informasiData', 'search'));
    }

    public function berkala(Request $request)
    {
        $search = $request->query('search');
        $informasiData = DokumenPublik::where('id_kat_info', 103)
            ->where('verify', 'y')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('ket', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.berkala', compact('informasiData', 'search'));
    }

    public function dikecualikan(Request $request)
    {
        $search = $request->query('search');
        $informasiData = DokumenPublik::where('id_kat_info', 100)
            ->where('verify', 'y')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('ket', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.dikecualikan', compact('informasiData', 'search'));
    }

    public function show($id)
    {
        $informasi = DokumenPublik::with(['kategori', 'skpd'])->findOrFail($id);

        return view('pages.informasi-publik.detail', compact('informasi'));
    }

    public function download($id)
    {
        $informasi = DokumenPublik::findOrFail($id);

        // Increment download count (handle NULL by treating as 0)
        $informasi->update([
            'jumlah_download' => \DB::raw('COALESCE(jumlah_download, 0) + 1')
        ]);

        $filePath = $informasi->file;

        if (!$filePath) {
            abort(404, 'File not found');
        }

        // Handle both storage paths and external URLs
        if (str_starts_with($filePath, 'http')) {
            return redirect($filePath);
        }

        if (!\Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return \Storage::disk('public')->download($filePath, $informasi->judul . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}

