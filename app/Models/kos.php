<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;
    protected $table = 'kos';
    protected $guarded = [];

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

    public function fasilitas()
    {
        return $this->morphMany(Fasilitas::class,'fasilitastable');
    }

    public function scopeFilterKategori($query,$request)
    {
        $query->when($request->kategori, function ($q) use ($request) {
            $q->whereHas('kategori',function($q) use($request){
                $q->whereIn('id',$request->kategori);
            });
        });
    }

    public function scopeFilterLokasi($query,$request)
    {
        $query->when($request->lokasi, function ($q) use ($request) {
            $q->whereRelation('kecamatan','id',$request->lokasi);
        });
    }
}
