<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatriksDip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MatriksDIPController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = MatriksDip::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $items
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        $data = MatriksDip::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Informasi Daftar Publik berhasil ditambahkan.',
            'data'    => $data
        ], 200);
    }

    public function show(string $id): JsonResponse
    {
        $item = MatriksDip::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $item
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $item = MatriksDip::findOrFail($id);

        $validated = $request->validate([
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Informasi Daftar Publik berhasil diperbarui.',
            'data'    => $item
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $item = MatriksDip::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Informasi Daftar Publik berhasil dihapus.',
            'data'    => null
        ], 200);
    }
}