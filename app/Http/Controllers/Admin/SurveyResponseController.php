<?php

namespace App\Http\Controllers\Admin;

use App\Models\SurveyResponse;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyResponseController extends Controller
{
    /**
     * Display a listing of survey responses.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = SurveyResponse::select('kode', 'nama', 'email', 'lembaga', 'tanggal', 'created_at')
            ->whereNotNull('kode')
            ->groupBy('kode', 'nama', 'email', 'lembaga', 'tanggal', 'created_at');
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('lembaga', 'like', "%{$search}%");
            });
        }
        
        $responses = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.survey-responses.index', compact('responses', 'search'));
    }

    /**
     * Display the specified survey response.
     */
    public function show($kode)
    {
        // Get all responses for this submission
        $responses = SurveyResponse::where('kode', $kode)->get();
        
        if ($responses->isEmpty()) {
            abort(404, 'Survey response not found');
        }
        
        // Get respondent info from first response
        $respondent = $responses->first();
        
        // Get all questions
        $questions = Survey::orderBy('urutan')->get();
        
        // Map answers to questions
        $answersMap = [];
        foreach ($responses as $response) {
            if ($response->kode_soal === 'MASUKAN') {
                $answersMap['masukan'] = $response->masukan;
            } else {
                $answersMap[$response->kode_soal] = $response->value;
            }
        }
        
        return view('admin.survey-responses.show', compact('respondent', 'questions', 'answersMap', 'kode'));
    }

    /**
     * Remove the specified survey response from storage.
     */
    public function destroy($kode)
    {
        // Delete all responses with this code
        $deleted = SurveyResponse::where('kode', $kode)->delete();
        
        if ($deleted) {
            return redirect()->route('admin.survey-responses.index')
                ->with('success', 'Survey berhasil dihapus.');
        }
        
        return redirect()->route('admin.survey-responses.index')
            ->with('error', 'Survey tidak ditemukan.');
    }
}
