<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriEmosiMental extends Model
{
    use HasFactory;
    protected $table = "galeri_emosi_mental";
    protected $primaryKey = "id_galeri_emosi_mental";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'foto', 'id_emosi_mental'
    ];
}