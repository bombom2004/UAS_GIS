<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_area',
        'data',
        'ket',
        'id_kategori'
    ];
    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}

