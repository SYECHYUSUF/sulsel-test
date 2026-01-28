<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyQuestionController extends Controller
{
    public function index()
    {
        $questions = Survey::orderBy('urutan')->paginate(20);
        return view('admin.survey-questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.survey-questions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        Survey::create($validated);

        return redirect()->route('admin.survey-questions.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    public function edit(Survey $surveyQuestion)
    {
        return view('admin.survey-questions.edit', compact('surveyQuestion'));
    }

    public function update(Request $request, Survey $surveyQuestion)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer|min:1',
            'soal' => 'required|string|max:1000',
            'tipe' => 'required|in:radio,textarea'
        ]);

        $surveyQuestion->update($validated);

        return redirect()->route('admin.survey-questions.index')
            ->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    public function destroy(Survey $surveyQuestion)
    {
        $surveyQuestion->delete();

        return redirect()->route('admin.survey-questions.index')
            ->with('success', 'Pertanyaan berhasil dihapus!');
    }
}
