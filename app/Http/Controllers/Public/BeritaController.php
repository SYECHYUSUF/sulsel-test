<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\BeritaResource;
use App\Http\Resources\Public\CategoryResource;
use App\Models\Berita;
use App\Models\Skpd;
use Illuminate\Http\Request;

/**
 * @group Manajemen Berita
 * * API untuk mengelola data berita
 */
class BeritaController extends Controller
{
    /**
     * Daftar Berita - Mengambil semua data berita dengan filter pencarian dan verifikasi.
     */
    public function index(Request $request)
    {
        $query = Berita::query()->with('skpd')->where('verify', 'y');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('id_skpd', $request->category);
        }

        $berita = $query->latest('tgl_upload')->paginate(9);

        $categories = Skpd::withCount(['berita' => fn($q) => $q->where('verify', 'y')])
            ->whereHas('berita', fn($q) => $q->where('verify', 'y'))
            ->get();

        return BeritaResource::collection($berita)->additional([
            'success' => true,
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    public function show($slug)
    {
        $berita = Berita::with('skpd')->where('slug', $slug)->firstOrFail();
        $berita->increment('viewers');

        $recent_news = Berita::where('verify', 'y')
            ->where('id_berita', '!=', $berita->id_berita)
            ->latest('tgl_upload')
            ->limit(5)
            ->get();

        return (new BeritaResource($berita))->additional([
            'success' => true,
            'recent_news' => BeritaResource::collection($recent_news),
        ]);
    }

    /**
     * Mengambil berita terbaru untuk landing page.
     */
    public function latest()
    {
        $berita = Berita::with('skpd')
            ->where('verify', 'y')
            ->latest('tgl_upload')
            ->limit(3)
            ->get();

        return BeritaResource::collection($berita);
    }
}
