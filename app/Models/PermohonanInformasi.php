<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanInformasi extends Model
{
    protected $table = 'tbl_permohonan_informasi';
    protected $primaryKey = 'id_permohonan';
    protected $guarded = [];

    /**
     * Relasi ke model Skpd
     */
    public function skpd(): BelongsTo
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }
}