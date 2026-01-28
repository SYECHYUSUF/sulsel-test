<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanRespon extends Model
{
    protected $table = 'tbl_permohonan_respon';
    protected $primaryKey = 'id_respon';
    protected $guarded = [];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    /**
     * Relasi ke PermohonanDisposisi
     */
    public function disposisi(): BelongsTo
    {
        return $this->belongsTo(PermohonanDisposisi::class, 'id_disposisi', 'id_disposisi');
    }

    /**
     * Relasi ke User (yang merespon)
     */
    public function respondedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
