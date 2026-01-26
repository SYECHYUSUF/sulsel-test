<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Skpd;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Filter by SKPD (as category)
        if ($request->filled('category')) {
            $query->where('id_skpd', $request->category);
        }

        // Only verified news
        $query->where('verify', 'y');

        // Get latest news
        $berita = $query->latest('tgl_upload')->paginate(9);
        
        // Get Categories (SKPDs that have news)
        // Or just all SKPDs? Let's get SKPDs with news count
        $categories = Skpd::withCount(['berita' => function($q) {
            $q->where('verify', 'y');
        }])
        ->having('berita_count', '>', 0)
        ->get();

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
        ->having('berita_count', '>', 0)
        ->get();

        return view('pages.berita.show', compact('berita', 'recent_news', 'categories'));
    }
}
