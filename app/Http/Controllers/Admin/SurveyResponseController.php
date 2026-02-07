<?php

namespace App\Http\Controllers\Admin;

use App\Models\SurveyResponse;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SurveyResponseController extends Controller
{
    /**
     * Display a listing of survey responses.
     */
    public function index(Request $request): JsonResponse
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
        
        return response()->json([
            'success' => true,
            'data'    => $responses
        ], 200);
    }

    /**
     * Display the specified survey response.
     */
    public function show($kode): JsonResponse
    {
        // Get all responses for this submission
        $responses = SurveyResponse::where('kode', $kode)->get();
        
        if ($responses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Survey response not found'
            ], 404);
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

        $data = [
            'respondent' => $respondent,
            'questions' => $questions,
            'answersMap' => $answersMap,
            'kode' => $kode
        ];
        
        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }

    /**
     * Remove the specified survey response from storage.
     */
    public function destroy($kode): JsonResponse
    {
        // Delete all responses with this code
        $deleted = SurveyResponse::where('kode', $kode)->delete();
        
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Survey berhasil dihapus.',
                'data'    => null
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Survey tidak ditemukan.'
        ], 404);
    }
}