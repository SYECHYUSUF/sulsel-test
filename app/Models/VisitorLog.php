<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'visit_date',
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     * Ini memastikan 'visit_date' diperlakukan sebagai objek Carbon/Tanggal.
     */
    protected $casts = [
        'visit_date' => 'date',
    ];
}