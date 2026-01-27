<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'tbl_notifications';
    protected $primaryKey = 'id_notification';
    protected $guarded = [];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * Get the parent notifiable model.
     */
    public function notifiable()
    {
        return $this->morphTo();
    }

    /**
     * User relation
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * SKPD relation
     */
    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'to_skpd_id', 'id_skpd');
    }

    /**
     * Custom creation helper
     */
    public static function send($data)
    {
        return self::create([
            'to_user_id' => $data['to_user_id'] ?? null,
            'to_skpd_id' => $data['to_skpd_id'] ?? null,
            'type' => $data['type'] ?? 'info',
            'title' => $data['title'],
            'message' => $data['message'],
            'url' => $data['url'] ?? null,
            'notifiable_id' => $data['notifiable_id'] ?? null,
            'notifiable_type' => $data['notifiable_type'] ?? null,
        ]);
    }
}
