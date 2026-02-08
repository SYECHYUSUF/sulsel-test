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
     * Menampilkan daftar respon survei yang dikelompokkan berdasarkan kode unik.
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
     * Menampilkan detail jawaban dari satu responden berdasarkan kode survei.
     */
    public function show(string $kode): JsonResponse
    {
        $responses = SurveyResponse::where('kode', $kode)->get();
        
        if ($responses->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data respon tidak ditemukan.'
            ], 404);
        }
        
        $respondent = $responses->first();
        $questions = Survey::orderBy('urutan')->get();
        
        $answersMap = [];
        foreach ($responses as $response) {
            if ($response->kode_soal === 'MASUKAN') {
                $answersMap['masukan'] = $response->masukan;
            } else {
                $answersMap[$response->kode_soal] = $response->value;
            }
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'respondent' => $respondent,
                'questions'  => $questions,
                'answers'    => $answersMap,
                'kode'       => $kode
            ]
        ], 200);
    }

    /**
     * Menghapus seluruh data respon terkait satu kode survei.
     */
    public function destroy(string $kode): JsonResponse
    {
        $deleted = SurveyResponse::where('kode', $kode)->delete();
        
        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Respon gagal dihapus atau data tidak ditemukan.'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Data survei berhasil dihapus.'
        ], 200);
    }
}