<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanRespon extends Model
{
    protected $table = 'tbl_pengajuan_respon';
    protected $primaryKey = 'id_respon';
    protected $guarded = [];

    /**
     * Relasi ke PengajuanDisposisi
     */
    public function disposisi(): BelongsTo
    {
        return $this->belongsTo(PengajuanDisposisi::class, 'id_disposisi', 'id_disposisi');
    }

    /**
     * Relasi ke User (yang memberikan respon)
     */
    public function responBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'respon_by');
    }
}
