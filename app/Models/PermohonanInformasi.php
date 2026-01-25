<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermohonanInformasi extends Model
{
    protected $table = 'tbl_permohonan_informasi';
    protected $primaryKey = 'id_permohonan';
    protected $guarded = [];
    protected $appends = ['status_label', 'status_color'];

    /**
     * Relasi ke model Skpd
     */
    /**
     * Relasi ke model Skpd
     */
    public function skpd(): BelongsTo
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }

    // Status Constants
    const STATUS_PENDING = 0;
    const STATUS_PROSES = 1;
    const STATUS_SELESAI = 2;
    const STATUS_TOLAK = 3;

    // Accessor for Status Label
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_PROSES => 'Sedang Diproses',
            self::STATUS_SELESAI => 'Selesai / Diberikan',
            self::STATUS_TOLAK => 'Ditolak',
            default => 'Unknown',
        };
    }

    // Accessor for Status Color Class
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_PROSES => 'bg-blue-100 text-blue-800',
            self::STATUS_SELESAI => 'bg-green-100 text-green-800',
            self::STATUS_TOLAK => 'bg-red-100 text-red-800',
            default => 'bg-slate-100 text-slate-800',
        };
    }
}