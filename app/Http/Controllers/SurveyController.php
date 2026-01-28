<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    public function create()
    {
        $questions = Survey::orderBy('urutan')->get();
        return view('pages.survey.isi-survey', compact('questions'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal' => 'required|date',
            'answer' => 'required|array',
            'masukan' => 'nullable|string',
        ]);

        // Generate unique code for this submission
        $kode = 'SRV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Get all questions
        $questions = Survey::orderBy('urutan')->get();

        // Store each answer
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

        // Store masukan/feedback if provided
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

        return redirect()->back()->with('success', 'Terima kasih! Survey Anda telah berhasil dikirim dan akan membantu kami meningkatkan kualitas pelayanan.');
    }

    public function showResults()
    {
        $questions = Survey::where('tipe', 'radio')->orderBy('urutan')->get();
        $options = ['Sangat Baik', 'Baik', 'Cukup Baik', 'Tidak Baik'];
        
        $results = [];
        foreach ($questions as $question) {
            $kode_soal = 'Q' . $question->urutan;
            $totalResponses = \DB::table('tbl_survey')
                ->where('kode_soal', $kode_soal)
                ->count();
            
            $stats = [];
            foreach ($options as $option) {
                $count = \DB::table('tbl_survey')
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
        
        return view('pages.survey.hasil-survey', compact('results'));
    }
}
