<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPekerjaan extends Model
{
    protected $table = 'master_pekerjaan';
    
    protected $fillable = [
        'nama_pekerjaan',
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
        return $this->hasMany(\App\Models\PermohonanInformasi::class, 'pekerjaan_id');
    }
}
