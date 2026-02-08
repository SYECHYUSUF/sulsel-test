<?php

namespace App\Http\Controllers;

use App\Models\Ikphn;
use App\Models\MatriksDip;
use Illuminate\Http\Request;

class MatriksDipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $matriksDip = MatriksDip::where('is_active', 1)
            ->when($search, function ($query, $search) {
                return $query->where('b', 'LIKE', "%{$search}%")
                    ->orWhere('c', 'LIKE', "%{$search}%")
                    ->orWhere('d', 'LIKE', "%{$search}%")
                    ->orWhere('e', 'LIKE', "%{$search}%")
                    ->orWhere('f', 'LIKE', "%{$search}%")
                    ->orWhere('g', 'LIKE', "%{$search}%");
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.index', compact('matriksDip', 'search'));
    }

    public function tahun(Request $request, $tahun)
    {
        $search = $request->query('search');
        $matriksDip = MatriksDip::where('g', 'LIKE', "%{$tahun}%")
            ->where('is_active', 1)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('b', 'LIKE', "%{$search}%")
                        ->orWhere('c', 'LIKE', "%{$search}%")
                        ->orWhere('d', 'LIKE', "%{$search}%")
                        ->orWhere('e', 'LIKE', "%{$search}%")
                        ->orWhere('f', 'LIKE', "%{$search}%")
                        ->orWhere('g', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.tahun', compact('matriksDip', 'search', 'tahun'));
    }

    public function pengadaan(Request $request)
    {
        $search = $request->query('search');

        $ikphns = Ikphn::query() // Mulai dengan query kosong
            ->when($search, function ($query, $search) {
                return $query->where('nama_jabatan', 'ilike', "%{$search}%");
            })
            ->latest() // Urutkan berdasarkan data terbaru (opsional)
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('pages.informasi-publik.pengadaan', compact('ikphns', 'search'));
    }
}
