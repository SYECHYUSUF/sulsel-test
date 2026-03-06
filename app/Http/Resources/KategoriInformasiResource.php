<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriInformasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_kat_info' => $this->id_kat_info,
            'nm_kat_info' => $this->nm_kat_info,
            'name' => $this->nm_kat_info,
            'slug' => $this->slug,
        ];
    }
}
