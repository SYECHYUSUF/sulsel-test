<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegratedService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IntegratedServiceController extends Controller
{
    /**
     * Menampilkan daftar layanan terintegrasi.
     */
    public function index(): JsonResponse
    {
        $services = IntegratedService::latest()->paginate(10);
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar layanan terintegrasi berhasil diambil',
            'data' => $services
        ], 200);
    }

    /**
     * Menyimpan layanan terintegrasi baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['title', 'description', 'link', 'is_active']);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('integrated_services', $filename, 'public');
            $data['icon'] = $filename;
        }

        $service = IntegratedService::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Layanan berhasil ditambahkan',
            'data' => $service
        ], 201);
    }

    /**
     * Menampilkan detail layanan terintegrasi.
     */
    public function show(string $id): JsonResponse
    {
        $service = IntegratedService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $service
        ], 200);
    }

    /**
     * Memperbarui data layanan terintegrasi.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $service = IntegratedService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'link' => 'required|url|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['title', 'description', 'link', 'is_active']);

        if ($request->hasFile('icon')) {
            // Menghapus ikon lama dari penyimpanan sebelum mengunggah yang baru
            if ($service->icon && Storage::disk('public')->exists('integrated_services/' . $service->icon)) {
                Storage::disk('public')->delete('integrated_services/' . $service->icon);
            }

            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('integrated_services', $filename, 'public');
            $data['icon'] = $filename;
        }

        $service->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Layanan berhasil diperbarui',
            'data' => $service
        ], 200);
    }

    /**
     * Menghapus layanan terintegrasi.
     */
    public function destroy(string $id): JsonResponse
    {
        $service = IntegratedService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Layanan tidak ditemukan'
            ], 404);
        }

        if ($service->icon && Storage::disk('public')->exists('integrated_services/' . $service->icon)) {
            Storage::disk('public')->delete('integrated_services/' . $service->icon);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Layanan berhasil dihapus'
        ], 200);
    }
}