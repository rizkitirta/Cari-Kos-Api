<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kos extends Model
{
    use HasFactory;
    protected $table = 'kos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class,'kategori_kos');
    }

    public function kecamatan()
    {
        return $this->belongsTo(IndonesiaKecamatan::class,'kecamatan_id','id');
    }

    public function kabkota()
    {
        return $this->belongsTo(IndonesiaKabkota::class,'kabkota_id','id');
    }

    public function provinsi()
    {
        return $this->belongsTo(IndonesiaProvinsi::class,'provinsi_id','id');
    }
}
