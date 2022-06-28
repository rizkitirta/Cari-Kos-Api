<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    protected $guarded = [];

    const TIPE  = [
        "kos" => "Fasilitas Kos",
        "kamar" => "Fasilitas Kamar"
    ];

    public function fasilitastable()
    {
       return $this->morphTo();
    }
}
