<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanKeberatan extends Model
{
    protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $guarded = [];
    protected $appends = ['status_label', 'status_color'];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd');
    }

    public function alasanPengajuan()
    {
        return $this->hasMany(AlasanPengajuan::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function disposisi()
    {
        return $this->hasMany(PengajuanDisposisi::class, 'id_pengajuan', 'id_pengajuan');
    }

    public function feedbackBy()
    {
        return $this->belongsTo(User::class, 'feedback_by');
    }

    /**
     * Relasi ke tabel Master Domisili
     */
    public function domisiliPemohon(): BelongsTo
    {
        return $this->belongsTo(MasterDomisili::class, 'pemohon_domisili_id', 'id');
    }

    /**
     * Relasi ke tabel Master Domisili (Kota Kuasa) jika diperlukan
     */
    public function domisiliKuasa(): BelongsTo
    {
        return $this->belongsTo(MasterDomisili::class, 'kuasa_domisili_id', 'id');
    }
    
    /**
     * Relasi ke data Master Pekerjaan
     */
    public function pekerjaan()
    {
         return $this->belongsTo(MasterPekerjaan::class, 'pekerjaan_id', 'id');
    }

    // Status Accessor for Label
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'n' => 'Menunggu Verifikasi',
            'd' => 'Disposisi',
            'a' => 'Dijawab',
            't' => 'Ditolak',
            'y' => 'Disetujui',
            default => 'Proses',
        };
    }

    // Status Accessor for Color Class
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'n' => 'bg-gray-100 text-gray-800',
            'p' => 'bg-yellow-100 text-yellow-800',
            'd' => 'bg-purple-100 text-purple-800',
            'a' => 'bg-blue-100 text-blue-800',
            't' => 'bg-red-100 text-red-800',
            'y' => 'bg-green-100 text-green-800',
            default => 'bg-slate-100 text-slate-800',
        };
    }
}