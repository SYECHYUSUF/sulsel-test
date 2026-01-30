<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $table = 'tbl_survey';
    protected $guarded = [];
    
    protected $casts = [
        'tanggal' => 'date',
    ];
    
    /**
     * Get all responses for a specific survey submission code
     */
    public static function getResponsesByCode($code)
    {
        return self::where('kode', $code)->get();
    }
    
    /**
     * Get unique survey submissions (grouped by code)
     */
    public static function getUniqueSubmissions()
    {
        return self::select('kode', 'nama', 'email', 'lembaga', 'tanggal', 'created_at')
            ->whereNotNull('kode')
            ->groupBy('kode', 'nama', 'email', 'lembaga', 'tanggal', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
