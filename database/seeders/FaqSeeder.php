<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $faqs = [
            [
                'pertanyaan' => 'Bagaimana cara mengajukan permohonan informasi publik?',
                'jawaban' => 'Anda dapat mengajukan permohonan informasi publik dengan datang langsung ke desk layanan PPID Pemprov Sulsel, atau secara online melalui website ini pada menu "Layanan" > "Permohonan Informasi". Pastikan Anda memiliki identitas diri (KTP) yang valid.',
                'is_active' => true,
                'urutan' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Apa saja syarat untuk mengajukan keberatan atas informasi?',
                'jawaban' => 'Pengajuan keberatan dapat dilakukan jika: 1. Permohonan informasi ditolak; 2. Informasi tidak disediakan secara berkala; 3. Permohonan tidak ditanggapi; 4. Permohonan tidak dipenuhi; 5. Biaya yang dikenakan tidak wajar; atau 6. Informasi yang diberikan tidak sesuai.',
                'is_active' => true,
                'urutan' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Berapa lama waktu yang dibutuhkan untuk memperoleh informasi?',
                'jawaban' => 'Sesuai dengan UU KIP, PPID wajib memberikan pemberitahuan tertulis paling lambat 10 (sepuluh) hari kerja sejak permohonan diterima. Badan Publik dapat memperpanjang waktu paling lambat 7 (tujuh) hari kerja.',
                'is_active' => true,
                'urutan' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Dimana lokasi kantor PPID Pemerintah Provinsi Sulawesi Selatan?',
                'jawaban' => 'Kantor PPID Utama Pemerintah Provinsi Sulawesi Selatan berlokasi di Kantor Gubernur Sulawesi Selatan, Jl. Urip Sumoharjo No. 269, Makassar. Anda juga dapat menghubungi kami melalui email atau telepon yang tertera di kontak.',
                'is_active' => true,
                'urutan' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Apakah layanan informasi ini dipungut biaya?',
                'jawaban' => 'Layanan informasi publik pada dasarnya tidak dipungut biaya (gratis). Namun, jika diperlukan penggandaan atau pengiriman dokumen fisik, biaya tersebut dibebankan kepada pemohon sesuai dengan standar biaya yang berlaku.',
                'is_active' => true,
                'urutan' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('tbl_faq')->insert($faqs);
    }
}
