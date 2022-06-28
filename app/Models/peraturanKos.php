<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanKos extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    const JUDUL = "Peraturan Kos";
}
