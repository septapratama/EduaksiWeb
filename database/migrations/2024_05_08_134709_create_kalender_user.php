<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalender_user', function (Blueprint $table) {
            $table->id('id_kalender');
            $table->uuid('uuid');
            $table->string('nama_acara', 50);
            $table->string('deskripsi', 4000);
            $table->enum('kategori', ['umum', 'penting', 'keluarga']);
            $table->date('tanggal');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kalender_user');
    }
};