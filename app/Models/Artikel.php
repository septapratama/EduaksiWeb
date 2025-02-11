<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = "artikel";
    protected $primaryKey = "id_artikel";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'judul','deskripsi','link_video','kategori'
    ];
}