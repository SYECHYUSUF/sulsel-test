<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterDomisili;

class MasterDomisiliSeeder extends Seeder
{
    public function run(): void
    {
        $domisili = [
            // Kota (3)
            ['nama' => 'Kota Makassar', 'type' => 'Kota'],
            ['nama' => 'Kota Palopo', 'type' => 'Kota'],
            ['nama' => 'Kota Parepare', 'type' => 'Kota'],
            
            // Kabupaten (21)
            ['nama' => 'Kabupaten Bantaeng', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Barru', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Bone', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Bulukumba', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Enrekang', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Gowa', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Jeneponto', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Kepulauan Selayar', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Luwu', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Luwu Timur', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Luwu Utara', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Maros', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Pangkajene dan Kepulauan', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Pinrang', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Sidenreng Rappang', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Sinjai', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Soppeng', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Takalar', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Tana Toraja', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Toraja Utara', 'type' => 'Kabupaten'],
            ['nama' => 'Kabupaten Wajo', 'type' => 'Kabupaten'],
            
            // Luar Sulsel
            ['nama' => 'Luar Sulawesi Selatan', 'type' => 'Luar'],
        ];

        foreach ($domisili as $item) {
            MasterDomisili::create([
                'nama_daerah' => $item['nama'],
                'provinsi' => $item['type'] === 'Luar' ? 'Lainnya' : 'Sulawesi Selatan',
                'is_active' => true,
            ]);
        }
    }
}
