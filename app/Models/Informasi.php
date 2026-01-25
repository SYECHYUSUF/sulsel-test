<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'tbl_informasi';
    protected $primaryKey = 'id_informasi';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriInformasi::class, 'id_kat_info', 'id_kat_info');
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }
}