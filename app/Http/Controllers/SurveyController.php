<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSurveyRequest;
use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function create(): JsonResponse
    {
        $questions = Survey::orderBy('urutan')->get();

        return response()->json([
            'success' => true,
            'data'    => $questions
        ], 200);
    }

    public function store(StoreSurveyRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $kode = 'SRV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        $questions = Survey::orderBy('urutan')->get();

        foreach ($questions as $question) {
            if (isset($validated['answer'][$question->id])) {
                SurveyResponse::create([
                    'kode' => $kode,
                    'nama' => $validated['nama'],
                    'email' => $validated['email'],
                    'lembaga' => $validated['lembaga'],
                    'alamat' => $validated['alamat'],
                    'tanggal' => $validated['tanggal'],
                    'kode_soal' => 'Q' . $question->urutan,
                    'value' => $validated['answer'][$question->id],
                    'masukan' => null,
                ]);
            }
        }

        if (!empty($validated['masukan'])) {
            SurveyResponse::create([
                'kode' => $kode,
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'lembaga' => $validated['lembaga'],
                'alamat' => $validated['alamat'],
                'tanggal' => $validated['tanggal'],
                'kode_soal' => 'MASUKAN',
                'value' => null,
                'masukan' => $validated['masukan'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Survey Anda telah berhasil dikirim.',
            'data'    => [
                'kode' => $kode,
                'input' => $validated
            ]
        ], 200);
    }

    public function showResults(): JsonResponse
    {
        $questions = Survey::where('tipe', 'radio')->orderBy('urutan')->get();
        $options = ['Sangat Baik', 'Baik', 'Cukup Baik', 'Tidak Baik'];
        
        $results = [];
        foreach ($questions as $question) {
            $kode_soal = 'Q' . $question->urutan;
            $totalResponses = DB::table('tbl_survey')
                ->where('kode_soal', $kode_soal)
                ->count();
            
            $stats = [];
            foreach ($options as $option) {
                $count = DB::table('tbl_survey')
                    ->where('kode_soal', $kode_soal)
                    ->where('value', $option)
                    ->count();
                
                $percentage = $totalResponses > 0 ? round(($count / $totalResponses) * 100) : 0;
                
                $stats[] = [
                    'option' => $option,
                    'count' => $count,
                    'percentage' => $percentage
                ];
            }
            
            $results[] = [
                'question' => $question,
                'stats' => $stats
            ];
        }
        
        return response()->json([
            'success' => true,
            'data'    => $results
        ], 200);
    }
}