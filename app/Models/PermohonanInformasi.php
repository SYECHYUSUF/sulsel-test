<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Relasi ke PermohonanDisposisi (multiple SKPDs)
     */
    public function disposisi(): HasMany
    {
        return $this->hasMany(PermohonanDisposisi::class, 'id_permohonan', 'id_permohonan');
    }

    // Status Constants
    const STATUS_PENDING = 0;
    const STATUS_PROSES = 1;
    const STATUS_SELESAI = 2;
    const STATUS_TOLAK = 3;
    const STATUS_BATAL = 4;
    const STATUS_DISPOSISI = 5;

    // Accessor for Status Label (Admin View)
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_PROSES => 'Diproses',
            self::STATUS_SELESAI => 'Diselesaikan',
            self::STATUS_TOLAK => 'Ditolak',
            self::STATUS_BATAL => 'Dibatalkan',
            self::STATUS_DISPOSISI => 'Disposisi',
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
            self::STATUS_BATAL => 'bg-gray-100 text-gray-800',
            self::STATUS_DISPOSISI => 'bg-purple-100 text-purple-800',
            default => 'bg-slate-100 text-slate-800',
        };
    }

    // Accessor for Applicant Status Label (Public View)
    public function getApplicantStatusLabelAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_PROSES => 'Diterima',
            self::STATUS_DISPOSISI => 'Diterima',
            self::STATUS_SELESAI => 'Diterima',
            self::STATUS_TOLAK => 'Ditolak',
            default => 'Menunggu Verifikasi',
        };
    }
}