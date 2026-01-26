<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Berita extends Model
{
    use Searchable;

    protected $table = 'tbl_berita';
    protected $primaryKey = 'id_berita';
    protected $guarded = [];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id_skpd');
    }

    /**
     * Nama indeks ini.
     */
    public function searchableAs(): string
    {
        return 'berita_index';
    }

    /**
     * Data apa saja yang bisa dicari.
     */
    public function toSearchableArray(): array
    {
        return [
            'id_berita' => (int) $this->id_berita,
            'judul'     => $this->judul,
            'isi'       => $this->isi,
            'id_kategori' => (int) $this->id_kategori,
            'status'    => $this->status,
            'created_at' => $this->created_at ? $this->created_at->timestamp : null,
        ];
    }

    /**
     * Karena primary key bukan 'id', override metode ini.
     */
    public function getScoutKey(): mixed
    {
        return $this->id_berita;
    }

    public function getScoutKeyName(): mixed
    {
        return 'id_berita';
    }
}
