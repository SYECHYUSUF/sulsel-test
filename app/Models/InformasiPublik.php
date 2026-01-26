<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPublik extends Model
{
    /** @use HasFactory<\Database\Factories\InformasiPublikFactory> */
    use HasFactory;

    protected $table = 'daftar_informasi_publik';
    protected $guarded = [];
}
