<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    protected $table = 'log_login';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = null;
    protected $guarded = [];
}
