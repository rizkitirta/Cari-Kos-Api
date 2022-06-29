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
        dd($this);
        return [
            'nama' => $this->nama,
            'lokasi' => $this->kecamatan->name,
            'pemilik_kos' =>  $this->user->name,
            'sisa_kamar' => $this->kamar_count,
            'fasilitas' => $this->whenLoaded('fasilitas'),
            'kategori' => $this->kategori->map(function($ktg){
                return [
                    'nama' => $ktg->nama
                ];
            }),
            'prev_page' => $this->prevPage(),
            'next_page' => $this->nextPage(),
            'per_page' => $this->perPage(),
        ];
    }
}
