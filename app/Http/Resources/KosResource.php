<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nama' => $this->nama,
            'kategori' => $this->whenLoaded('kategori'),
            'lokasi' => $this->whenLoaded('kecamatan'),
            'fasilitas' => $this->whenLoaded('fasilitas'),
            'sisa_kamar' => $this->sisa_kamar,
            'pemilik_kos' => $this->whenLoaded('user'),
        ]
    }
}
