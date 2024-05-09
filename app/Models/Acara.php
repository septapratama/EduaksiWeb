<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $table = "kalender_user";
    protected $primaryKey = "id_kalender";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'nama_acara', 'deskripsi', 'kategori', 'tanggal'
    ];
}