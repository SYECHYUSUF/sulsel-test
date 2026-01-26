<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SlideBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = \App\Models\Slide::latest()->paginate(10);
        return view('admin.slide-banner.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slide-banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nm_slide' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [];

        if ($request->hasFile('nm_slide')) {
            $file = $request->file('nm_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('slide_banner', $filename, 'public');
            $data['nm_slide'] = $filename;
        }

        \App\Models\Slide::create($data);

        return redirect()->route('admin.slide-banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slide = \App\Models\Slide::findOrFail($id);
        return view('admin.slide-banner.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slide = \App\Models\Slide::findOrFail($id);

        $request->validate([
            'nm_slide' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = [];

        if ($request->hasFile('nm_slide')) {
            // Hapus gambar lama jika ada
            if ($slide->nm_slide && \Illuminate\Support\Facades\Storage::disk('public')->exists('slide_banner/' . $slide->nm_slide)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete('slide_banner/' . $slide->nm_slide);
            }

            $file = $request->file('nm_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('slide_banner', $filename, 'public');
            $data['nm_slide'] = $filename;
        }

        $slide->update($data);

        return redirect()->route('admin.slide-banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slide = \App\Models\Slide::findOrFail($id);

        if ($slide->nm_slide && \Illuminate\Support\Facades\Storage::disk('public')->exists('slide_banner/' . $slide->nm_slide)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete('slide_banner/' . $slide->nm_slide);
        }

        $slide->delete();

        return redirect()->route('admin.slide-banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}
