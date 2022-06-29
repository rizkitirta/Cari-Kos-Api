<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $table = 'kamar';
    protected $guarded = [];

    public function fasilitas()
    {
        return $this->morphMany(Fasilitas::class,'fasilitastable');
    }
}
