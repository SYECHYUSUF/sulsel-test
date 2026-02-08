<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeritaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_berita,
            'title' => $this->judul,
            'slug' => $this->slug,
            'content' => $this->deskripsi,
            'image' => $this->img_berita,
            'viewers' => $this->viewers,
            'date' => $this->tgl_upload,
            'category' => new CategoryResource($this->whenLoaded('skpd')),
        ];
    }
}
