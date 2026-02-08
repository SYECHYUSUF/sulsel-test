<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatriksDipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'jenis_informasi' => $this->a,
            'ringkasan_isi' => $this->b,
            'pejabat_menguasai' => $this->c,
            'penanggung_jawab' => $this->d,
            'waktu_pembuatan' => $this->e,
            'format' => $this->f,
            'tahun' => $this->g,
            'tautan_dokumen' => $this->h,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}