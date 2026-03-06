<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $table = 'tbl_skpd';
    protected $primaryKey = 'id_skpd';
    public $incrementing = false; // Karena id_skpd adalah string (varchar)
    protected $keyType = 'string';
    protected $guarded = [];

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_skpd', 'id_skpd');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_skpd', 'id_skpd');
    }
}