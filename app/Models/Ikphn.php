<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ikphn extends Model
{
    protected $guarded = ['id'];

    // Tambahkan ini
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }
}