<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;
    protected $table = "konsultasi";
    protected $primaryKey = "id_konsultasi";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'nama_lengkap','jenis_kelamin','no_telpon','alamat','email','foto'
    ];
}