<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Faq::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('pertanyaan', 'LIKE', "%{$search}%")
                ->orWhere('jawaban', 'LIKE', "%{$search}%");
        }

        $faqs = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->expectsJson()) {
            return response()->json($faqs);
        }

        return response()->json([
            'success' => true,
            'data' => $faqs
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $faq = Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'is_active' => $request->has('is_active') ? $request->is_active : true, // Default true if not present or handle checkbox
            'urutan' => $request->urutan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil ditambahkan.',
            'data' => $faq
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $faq
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'is_active' => 'boolean',
            'urutan' => 'nullable|integer',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'is_active' => $request->is_active,
            'urutan' => $request->urutan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil diperbarui',
            'data' => $faq
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil dihapus.',
        ], 200);
    }
}
