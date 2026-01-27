<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatriksDip extends Model
{
    protected $table = 'daftar_informasi_publik';
    protected $guarded = [];

    /**
     * Menyimpan label kolom secara terpusat
     */
    public static function columnLabels()
    {
        return [
            'a' => 'Jenis Informasi',
            'b' => 'Ringkasan Isi',
            'c' => 'Pejabat yang Menguasai',
            'd' => 'Penanggung Jawab',
            'e' => 'Waktu Pembuatan',
            'f' => 'Format',
            'g' => 'Tahun',
            'h' => 'Tautan Dokumen',
        ];
    }
}
