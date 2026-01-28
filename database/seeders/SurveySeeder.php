<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Survey;

class SurveySeeder extends Seeder
{
    public function run()
    {
        DB::table('ms_survey')->truncate();

        $questions = [
            [
                'urutan' => 1,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Sistem Pelayanan Informasi Yang Disediakan Oleh PPID Provinsi Sulawesi Selatan Melalui Sistem Permohonan Informasi Secara Online Melalui Website/Portal PPID?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 2,
                'soal' => 'Bagaimana Pendapat Saudara Mengenai Kemudahan Pengajuan Permohonan Informasi Melalui Sistem Permohonan Informasi Yang Disediakan Oleh PPID Provinsi Sulawesi Selatan Saat Ini?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 3,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Kualitas Informasi Yang Tersedia Pada Website/Portal PPID Provinsi Sulawesi Selatan https://Ppid.Sulselprov.Go.Id/?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 4,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Kemudahan Dalam Mengakses Informasi Pada Website/Portal PPID Provinsi Sulawesi Selatan Https://Ppid.Sulselprov.Go.Id/?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 5,
                'soal' => 'Seberapa Baik Menurut Saudara, Tampilan Pada Website/Portal PPID Provinsi Sulawesi Selatan Https://Ppid.Sulselprov.Go.Id/?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 6,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Pengetahuan Dan Penguasaan Materi Petugas Data Dan Informasi Publik PPID Provinsi Sulawesi Selatan Dalam Memberikan Pelayanan Informasi Publik?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 7,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Tanggung Jawab Petugas Data Dan Informasi Publik PPID Provinsi Sulawesi Selatan Dalam Memberikan Pelayanan Informasi Publik?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 8,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Kesopanan Dan Keramahan Petugas Data Dan Informasi Publik PPID Provinsi Sulawesi Selatan Dalam Memberikan Pelayanan Informasi Publik?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 9,
                'soal' => 'Bagaimana Menurut Saudara Tentang Kejelasan Informasi Yang Disampaikan Oleh Petugas Data Dan Informasi Publik PPID Provinsi Sulawesi Selatan Ketika Memberikan Pelayanan Informasi Publik?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 10,
                'soal' => 'Bagaimana Menurut Saudara Tentang Kelengkapan Persyaratan Yang Harus Dipenuhi Dalam Permohonan Informasi Publik Di PPID Provinsi Sulawesi Selatan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 11,
                'soal' => 'Bagaimana Menurut Saudara Tentang Prosedur/Tata Cara/Alur Mekanisme Pelayanan Informasi Publik Di PPID Provinsi Sulawesi Selatan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 12,
                'soal' => 'Bagaimana Pendapat Saudara Mengenai Ketepatan Waktu PPID Provinsi Sulawesi Selatan Dalam Memberikan Pelayanan Informasi Publik?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 13,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Kesesuaian Informasi Yang Diberikan Oleh PPID Provinsi Sulawesi Selatan Terhadap Permohonan Informasi Publik Yang Diajukan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 14,
                'soal' => 'Bagaimana Menurut Saudara Tentang Kenyamanan Fasilitas Meja/Desk Pelayanan Permohonan Informasi Publik Di PPID Provinsi Sulawesi Selatan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 15,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Keamanan Pelayanan Informasi Publik Di PPID Provinsi Sulawesi Selatan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 16,
                'soal' => 'Bagaimana Pendapat Saudara Tentang Keadilan/Kesetaraan Untuk Mendapatkan Pelayanan Informasi Publik Dari PPID Provinsi Sulawesi Selatan?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 17,
                'soal' => 'Bagaimana Menurut Saudara Terhadap Maklumat Pelayanan Informasi Publik Provinsi Sulawesi Selatan (Profesional, Akurat Dan Bertanggung Jawab Dalam Memberikan Pelayanan Informasi Publik)?',
                'tipe' => 'radio',
            ],
            [
                'urutan' => 18,
                'soal' => 'Tuliskan Komentar/Usulan Saudara Terhadap Kemajuan Dan Pengembangan Pelayanan Informasi Publik Melalui PPID Provinsi Sulawesi Selatan',
                'tipe' => 'textarea',
            ],
        ];

        foreach ($questions as $question) {
            Survey::create($question);
        }
    }
}
