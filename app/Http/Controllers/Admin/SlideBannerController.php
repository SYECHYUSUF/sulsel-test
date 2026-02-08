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
            $data['nm_slide'] = $request->file('nm_slide')->store('slide-banner', 'public');
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
            if ($slide->nm_slide && Storage::disk('public')->exists($slide->nm_slide)) {
                Storage::disk('public')->delete($slide->nm_slide);
            }
            $slide->update([
                'nm_slide' => $request->file('nm_slide')->store('slide-banner', 'public')
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

        if ($slide->nm_slide && Storage::disk('public')->exists($slide->nm_slide)) {
            Storage::disk('public')->delete($slide->nm_slide);
        }

        $slide->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner berhasil dihapus'
        ], 200);
    }
}