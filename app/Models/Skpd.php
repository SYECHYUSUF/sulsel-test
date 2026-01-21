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
}