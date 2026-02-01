<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterPekerjaan;

class MasterPekerjaanSeeder extends Seeder
{
    public function run(): void
    {
        $pekerjaan = [
            'PNS (Pegawai Negeri Sipil)',
            'TNI/Polri',
            'Pegawai Swasta',
            'Wiraswasta/Pengusaha',
            'Pelajar/Mahasiswa',
            'Ibu Rumah Tangga',
            'Petani/Peternak',
            'Nelayan',
            'Buruh',
            'Pensiunan',
            'Tenaga Kesehatan',
            'Guru/Dosen',
            'Jurnalis/Wartawan',
            'Advokat/Pengacara',
            'Lainnya',
        ];

        foreach ($pekerjaan as $item) {
            MasterPekerjaan::create([
                'nama_pekerjaan' => $item,
                'is_active' => true,
            ]);
        }
    }
}
