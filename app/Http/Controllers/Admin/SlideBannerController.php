<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideBanner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SlideBannerController extends Controller
{
    /**
     * Menampilkan daftar banner slide.
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
     * Menampilkan detail banner slide.
     */
    public function show(string $id): JsonResponse
    {
        $slide = SlideBanner::find($id);

        if (!$slide) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $slide
        ], 200);
    }

    /**
     * Menambahkan banner slide baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_slide' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [];
        if ($request->hasFile('nm_slide')) {
            $path = $request->file('nm_slide')->store('slide-banner', 'public');
            $data['nm_slide'] = basename($path);
        }

        $slide = SlideBanner::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil ditambahkan',
            'data'    => $slide
        ], 201);
    }

    /**
     * Memperbarui file banner slide.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $slide = SlideBanner::find($id);

        if (!$slide) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nm_slide' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('nm_slide')) {
            $oldFile = str_replace('slide-banner/', '', $slide->nm_slide);
            if ($oldFile && Storage::disk('public')->exists('slide-banner/' . $oldFile)) {
                Storage::disk('public')->delete('slide-banner/' . $oldFile);
            }
            $path = $request->file('nm_slide')->store('slide-banner', 'public');
            $slide->update([
                'nm_slide' => basename($path)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil diperbarui',
            'data'    => $slide
        ], 200);
    }

    /**
     * Menghapus banner slide.
     */
    public function destroy(string $id): JsonResponse
    {
        $slide = SlideBanner::find($id);

        if (!$slide) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        $oldFile = str_replace('slide-banner/', '', $slide->nm_slide);
        if ($oldFile && Storage::disk('public')->exists('slide-banner/' . $oldFile)) {
            Storage::disk('public')->delete('slide-banner/' . $oldFile);
        }

        $slide->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil dihapus'
        ], 200);
    }
}