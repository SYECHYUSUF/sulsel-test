<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Skpd;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query()->with('skpd'); // Eager load relasi SKPD

        // Logic pencarian yang Anda miliki
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori/SKPD
        if ($request->filled('category')) {
            $query->where('id_skpd', $request->category);
        }

        // Hanya berita terverifikasi
        $query->where('verify', 'y');

        // Ambil data terbaru dengan paginasi
        $berita = $query->latest('tgl_upload')->paginate(9);
        
        // Ambil data kategori untuk sidebar/dropdown
        $categories = Skpd::withCount(['berita' => function($q) {
                $q->where('verify', 'y');
            }])
            ->whereHas('berita', function($q) {
                $q->where('verify', 'y');
            })
            ->get();

        // JIKA REQUEST ADALAH AJAX/JSON (Untuk Lazy Load/Alpine)
        if ($request->wantsJson()) {
            return response()->json($berita);
        }

        // Initial Load
        return view('pages.berita.index', compact('berita', 'categories'));
    }

    public function show($slug)
    {
        // Assuming we look up by slug, or ID if slug not unique or used
        // Admin controller generates slug, but let's check if 'slug' column exists.
        // Yes, Admin controller sets $data['slug'].
        $berita = Berita::where('slug', $slug)->firstOrFail();
        
        // Increment viewers
        $berita->increment('viewers');

        // Recent news for sidebar
        $recent_news = Berita::where('verify', 'y')
                            ->where('id_berita', '!=', $berita->id_berita)
                            ->latest('tgl_upload')
                            ->limit(5)
                            ->get();

        $categories = Skpd::withCount(['berita' => function($q) {
                $q->where('verify', 'y');
            }])
            ->whereHas('berita', function($q) {
                $q->where('verify', 'y');
            })
            ->get();
            
        return view('pages.berita.show', compact('berita', 'recent_news', 'categories'));
    }
}
