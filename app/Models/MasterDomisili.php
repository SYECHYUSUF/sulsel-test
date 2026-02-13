<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDomisili extends Model
{
    protected $table = 'master_domisili';
    
    protected $fillable = [
        'nama_daerah',
        'provinsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active records
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Relationship: Has many permohonan informasi
     */
    public function permohonanInformasi()
    {
        return $this->hasMany(PermohonanInformasi::class, 'domisili_id');
    }

  

    /**
     * Relationship: Has many pengajuan keberatan
    */
    public function daftarPengajuanPemohon()
    {
        // Mencari di mana ID kota ini muncul di kolom pemohon_domisili_id
        return $this->hasMany(PengajuanKeberatan::class, 'pemohon_domisili_id', 'id');
    }

    /**
     * Relationship: Has many pengajuan keberatan
    */
    public function daftarPengajuanKuasa()
    {
        // Mencari di mana ID kota ini muncul di kolom kuasa_domisili_id
        return $this->hasMany(PengajuanKeberatan::class, 'kuasa_domisili_id', 'id');
    }
}
