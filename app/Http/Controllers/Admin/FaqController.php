<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Menampilkan daftar FAQ dengan fitur pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Faq::query();
        if ($request->filled('search')) {
            $query->where('pertanyaan', 'LIKE', "%{$request->search}%")
                  ->orWhere('jawaban', 'LIKE', "%{$request->search}%");
        }

        return response()->json(['success' => true, 'data' => $query->orderBy('created_at', 'desc')->paginate(10)]);
    }

    /**
     * Menyimpan FAQ baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $faq = Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'is_active' => $request->get('is_active', true),
            'urutan' => $request->urutan,
        ]);

        return response()->json(['success' => true, 'message' => 'FAQ berhasil ditambahkan.', 'data' => $faq], 201);
    }

    /**
     * Menampilkan detail FAQ.
     */
    public function show(string $id): JsonResponse
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
        return response()->json(['success' => true, 'data' => $faq]);
    }

    /**
     * Memperbarui data FAQ.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $faq->update($validator->validated());

        return response()->json(['success' => true, 'message' => 'FAQ berhasil diperbarui', 'data' => $faq]);
    }

    /**
     * Menghapus FAQ.
     */
    public function destroy(string $id): JsonResponse
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
        $faq->delete();

        return response()->json(['success' => true, 'message' => 'FAQ berhasil dihapus.']);
    }
}