<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalLiterasi extends Model
{
    use HasFactory;
    protected $table = "digital_literasi";
    protected $primaryKey = "id_digital";
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'judul','deskripsi','link_video','rentang_usia'
    ];
}