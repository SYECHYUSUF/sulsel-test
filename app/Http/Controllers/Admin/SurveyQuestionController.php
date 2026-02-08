<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyQuestionController extends Controller
{
    /**
     * Menampilkan daftar pertanyaan survei.
     */
    public function index(): JsonResponse
    {
        $questions = Survey::orderBy('urutan')->get();

        return response()->json([
            'success' => true,
            'data'    => $questions
        ], 200);
    }

    /**
     * Menambahkan pertanyaan survei baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $survey = Survey::create($request->only(['urutan', 'soal', 'tipe']));

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil ditambahkan!',
            'data'    => $survey
        ], 201);
    }

    /**
     * Menampilkan detail satu pertanyaan survei.
     */
    public function show(string $id): JsonResponse
    {
        $survey = Survey::find($id);

        if (!$survey) {
            return response()->json([
                'success' => false,
                'message' => 'Pertanyaan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $survey
        ], 200);
    }

    /**
     * Memperbarui pertanyaan survei.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $survey = Survey::find($id);

        if (!$survey) {
            return response()->json([
                'success' => false,
                'message' => 'Pertanyaan tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $survey->update($request->only(['urutan', 'soal', 'tipe']));

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil diperbarui!',
            'data'    => $survey
        ], 200);
    }

    /**
     * Menghapus pertanyaan survei.
     */
    public function destroy(string $id): JsonResponse
    {
        $survey = Survey::find($id);

        if (!$survey) {
            return response()->json([
                'success' => false,
                'message' => 'Pertanyaan tidak ditemukan.'
            ], 404);
        }

        $survey->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil dihapus.'
        ], 200);
    }
}