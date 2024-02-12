<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencatatan extends Model
{
    use HasFactory;
    protected $table = "pencatatan";
    protected $primaryKey = "id_pencatatan";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'nama_anak', 'umur', 'gol_darah', 'hasil_gizi', 'id_user'
    ];
}