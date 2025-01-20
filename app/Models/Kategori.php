<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'icon',
        'parent_id',
    ];
    public function Area(){
        return $this->belongsTo(Area::class, 'id');
    }
}
