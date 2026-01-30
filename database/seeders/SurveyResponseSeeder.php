<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveyResponseSeeder extends Seeder
{
    public function run()
    {
        DB::table('tbl_survey')->truncate();

        // Sample percentages from images for questions 1-17
        // Format: [Sangat Baik %, Baik %, Cukup Baik %, Tidak Baik %]
        $percentages = [
            [56, 31, 0, 13],   // Q1
            [56, 31, 0, 13],   // Q2
            [44, 38, 0, 19],   // Q3
            [69, 25, 0, 6],    // Q4
            [31, 56, 0, 13],   // Q5
            [44,  40, 0, 16],   // Q6
            [56, 31, 0, 13],   // Q7
            [56, 31, 0, 13],   // Q8
            [44, 38, 13, 6],   // Q9
            [69, 25, 0, 6],    // Q10
            [44, 44, 0, 13],   // Q11
            [31, 44, 0, 13],   // Q12
            [69, 19, 6, 6],    // Q13
            [56, 25, 0, 6],    // Q14
            [44, 38, 6, 13],   // Q15
            [38, 50, 0, 6],    // Q16
            [50, 25, 6, 6],    // Q17
        ];

        $totalResponses = 16; // Total number of sample responses
        $options = ['Sangat Baik', 'Baik', 'Cukup Baik', 'Tidak Baik'];

        // Generate responses for each respondent
        for ($respondentNum = 1; $respondentNum <= $totalResponses; $respondentNum++) {
            for ($questionNum = 1; $questionNum <= 17; $questionNum++) {
                // Determine which answer this respondent gave based on percentages
                $rand = rand(1, 100);
                $cumulative = 0;
                $selectedOption = 'Sangat Baik';
                
                foreach ($percentages[$questionNum - 1] as $idx => $percentage) {
                    $cumulative += $percentage;
                    if ($rand <= $cumulative) {
                        $selectedOption = $options[$idx];
                        break;
                    }
                }

                DB::table('tbl_survey')->insert([
                    'kode' => 'RESP' . str_pad($respondentNum, 4, '0', STR_PAD_LEFT),
                    'nama' => 'Responden ' . $respondentNum,
                    'email' => 'responden' . $respondentNum . '@example.com',
                    'lembaga' => $respondentNum % 2 == 0 ? 'Lembaga ' . chr(65 + ($respondentNum % 10)) : 'Individu',
                    'alamat' => 'Makassar, Sulawesi Selatan',
                    'tanggal' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')),
                    'kode_soal' => 'Q' . $questionNum,
                    'value' => $selectedOption,
                    'masukan' => $questionNum == 1 ? 'Terima kasih atas pelayanannya' : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Add response for question 18 (essay)
            DB::table('tbl_survey')->insert([
                'kode' => 'RESP' . str_pad($respondentNum, 4, '0', STR_PAD_LEFT),
                'nama' => 'Responden ' . $respondentNum,
                'email' => 'responden' . $respondentNum . '@example.com',
                'lembaga' => $respondentNum % 2 == 0 ? 'Lembaga ' . chr(65 + ($respondentNum % 10)) : 'Individu',
                'alamat' => 'Makassar, Sulawesi Selatan',
                'tanggal' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')),
                'kode_soal' => 'Q18',
                'value' => 'Terima kasih atas pelayanan yang baik. Semoga terus ditingkatkan.',
                'masukan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
