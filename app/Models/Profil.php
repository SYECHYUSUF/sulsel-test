<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'tbl_profil';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'nm_profil',
        'deskripsi',
        'slug',
        'tipe',
        'file_banner',    // Maklumat banner
        'foto_gubernur',  // Profil Pemprov
        'foto_wakil',     // Profil Pemprov
        'foto_kepala',    // Sambutan
        'ig_gubernur',
        'fb_gubernur',
        'ig_wakil',
        'fb_wakil',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get profil by tipe
     */
    public static function getByTipe($tipe)
    {
        return self::where('tipe', $tipe)->first();
    }

    /**
     * Get profil by slug
     */
    public static function getBySlug($slug)
    {
        return self::where('slug', $slug)->first();
    }
}