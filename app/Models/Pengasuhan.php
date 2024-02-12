<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengasuhan extends Model
{
    use HasFactory;
    protected $table = "pengasuhan";
    protected $primaryKey = "id_pengasuhan";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'judul','deskripsi','link_video','rentang_usia'
    ];
}