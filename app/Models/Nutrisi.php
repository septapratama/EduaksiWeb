<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrisi extends Model
{
    use HasFactory;
    protected $table = "nutrisi";
    protected $primaryKey = "id_nutrisi";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'judul','deskripsi','link_video','rentang_usia'
    ];
}