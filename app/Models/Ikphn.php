<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ikphn extends Model
{
    protected $guarded = ['id'];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }
}