<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideBanner extends Model
{
    use HasFactory;

    protected $table = 'tbl_slide';
    protected $primaryKey = 'id_slide';

    protected $fillable = [
        'nm_slide',
        'order',
        'is_active',
    ];

    /**
     * Scope to get only active slides
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
