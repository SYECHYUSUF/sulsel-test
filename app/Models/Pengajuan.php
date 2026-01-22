<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $guarded = [];

     public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd');
    }
}