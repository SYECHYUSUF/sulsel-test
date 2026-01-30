<?php

namespace App\Http\Controllers;

use App\Models\MatriksDip;
use Illuminate\Http\Request;

class MatriksDipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matriksDip = MatriksDip::where('is_active', 1)->paginate(10);

        return view('pages.informasi-publik.index', compact('matriksDip'));
    }

    public function tahun2023()
    {
        $matriksDip = MatriksDip::where('g', 'LIKE', '%2023%')
            ->where('is_active', 1)
            ->paginate(10);
        return view('pages.informasi-publik.tahun-2023', compact('matriksDip'));
    }

    public function tahun2024()
    {
        $matriksDip = MatriksDip::where('g', 'LIKE', '%2024%')
            ->where('is_active', 1)
            ->paginate(10);
        return view('pages.informasi-publik.tahun-2024', compact('matriksDip'));
    }

    public function tahun2025()
    {
        $matriksDip = MatriksDip::where('g', 'LIKE', '%2025%')
            ->where('is_active', 1)
            ->paginate(10);
        return view('pages.informasi-publik.tahun-2025', compact('matriksDip'));
    }

    public function pengadaan()
    {
        $matriksDip = MatriksDip::where(function ($q) {
            $q->where('a', 'LIKE', '%Pengadaan%')
                ->orWhere('b', 'LIKE', '%Pengadaan%');
        })
            ->where('is_active', 1)
            ->paginate(10);
        return view('pages.informasi-publik.pengadaan', compact('matriksDip'));
    }
}
