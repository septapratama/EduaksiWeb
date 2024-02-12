<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_emosi_mental', function (Blueprint $table) {
            $table->id('id_galeri_emosi_mental');
            $table->text('foto');
            $table->unsignedBigInteger('id_emosi_mental');
            $table->foreign('id_emosi_mental')->references('id_emosi_mental')->on('emosi_mental')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_emosi_mental');
    }
};