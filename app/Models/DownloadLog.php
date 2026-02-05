<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    protected $guarded = [];

    protected $table = 'download_logs';

    /**
     * Get the parent downloadable model.
     */
    public function downloadable()
    {
        return $this->morphTo();
    }
}
