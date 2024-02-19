<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    { 
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->uuid('uuid');
            $table->string('nama_lengkap',50);
            $table->enum('jenis_kelamin',['laki-laki','perempuan']);
            $table->string('alamat',100);
            $table->string('no_telpon',15);
            $table->string('email',45);
            $table->string('foto',50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};