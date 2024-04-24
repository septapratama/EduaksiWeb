<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "event";
    protected $primaryKey = "id_event";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'nama_event', 'deskripsi', 'tempat', 'tanggal_awal', 'tanggal_akhir'
    ];
}