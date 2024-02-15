<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_literasi', function (Blueprint $table) {
            $table->id('id_disi');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->string('link_video');
            $table->string('rentang_usia');
            $table->text('foto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_literasi');
    }
};