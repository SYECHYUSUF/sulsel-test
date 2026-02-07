<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideBanner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $slides = SlideBanner::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $slides
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nm_slide' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        $data = [];

        if ($request->hasFile('nm_slide')) {
            $file = $request->file('nm_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('slide-banner', $filename, 'public');
            $data['nm_slide'] = $filename;
        }

        $slide = SlideBanner::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil ditambahkan.',
            'data'    => $slide
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $slide = SlideBanner::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $slide
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $slide = SlideBanner::findOrFail($id);

        $request->validate([
            'nm_slide' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120|dimensions:min_width=2752,min_height=1536',
        ]);

        $data = [];

        if ($request->hasFile('nm_slide')) {
            // Hapus gambar lama jika ada
            if ($slide->nm_slide && Storage::disk('public')->exists('slide-banner/' . $slide->nm_slide)) {
                Storage::disk('public')->delete('slide-banner/' . $slide->nm_slide);
            }

            $file = $request->file('nm_slide');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('slide-banner', $filename, 'public');
            $data['nm_slide'] = $filename;
        }

        $slide->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil diperbarui.',
            'data'    => $slide
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $slide = SlideBanner::findOrFail($id);

        if ($slide->nm_slide && Storage::disk('public')->exists('slide-banner/' . $slide->nm_slide)) {
            Storage::disk('public')->delete('slide-banner/' . $slide->nm_slide);
        }

        $slide->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil dihapus.'
        ], 200);
    }
}