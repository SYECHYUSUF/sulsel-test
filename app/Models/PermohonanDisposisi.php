<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PermohonanDisposisi extends Model
{
    protected $table = 'tbl_permohonan_disposisi';
    protected $primaryKey = 'id_disposisi';
    protected $guarded = [];

    // Status Constants
    const STATUS_PENDING = 'pending';
    const STATUS_DIPROSES = 'diproses';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';

    /**
     * Relasi ke PermohonanInformasi
     */
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(PermohonanInformasi::class, 'id_permohonan', 'id_permohonan');
    }

    /**
     * Relasi ke Skpd
     */
    public function skpd(): BelongsTo
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }

    /**
     * Relasi ke User (yang melakukan disposisi)
     */
    public function disposisiBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'disposisi_by');
    }

    /**
     * Relasi ke Respon
     */
    public function respon(): HasMany
    {
        return $this->hasMany(PermohonanRespon::class, 'id_disposisi', 'id_disposisi');
    }

    /**
     * Accessor for status badge color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'bg-yellow-100 text-yellow-800',
            self::STATUS_DIPROSES => 'bg-blue-100 text-blue-800',
            self::STATUS_SELESAI => 'bg-green-100 text-green-800',
            self::STATUS_DITOLAK => 'bg-red-100 text-red-800',
            default => 'bg-slate-100 text-slate-800',
        };
    }

    /**
     * Accessor for status label
     */
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
            default => 'Unknown',
        };
    }
}
