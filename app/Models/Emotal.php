<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotal extends Model
{
    use HasFactory;
    protected $table = "emosi_mental";
    protected $primaryKey = "id_emotal";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'judul','deskripsi','link_video','rentang_usia'
    ];
}