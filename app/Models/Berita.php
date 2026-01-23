<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'tbl_berita';
    protected $primaryKey = 'id_berita';
    protected $guarded = [];
    public $timestamps = false;

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }
}
