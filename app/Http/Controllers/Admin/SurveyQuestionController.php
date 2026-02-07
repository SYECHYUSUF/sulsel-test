<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    public function index(): JsonResponse
    {
        $questions = Survey::orderBy('urutan')->get();

        return response()->json([
            'success' => true,
            'data'    => $questions
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        $survey = Survey::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil ditambahkan!',
            'data'    => $survey
        ], 201);
    }

    public function show(Survey $surveyQuestion): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $surveyQuestion
        ], 200);
    }

    public function update(Request $request, Survey $surveyQuestion): JsonResponse
    {
        $validated = $request->validate([
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        $surveyQuestion->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil diperbarui!',
            'data'    => $surveyQuestion
        ], 200);
    }

    public function destroy(Survey $surveyQuestion): JsonResponse
    {
        $surveyQuestion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pertanyaan berhasil dihapus!'
        ], 200);
    }
}