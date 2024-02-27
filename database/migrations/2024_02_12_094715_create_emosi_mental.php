<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emosi_mental', function (Blueprint $table) {
            $table->id('id_emotal');
            $table->uuid('uuid');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->string('link_video')->nullable();
            $table->enum('rentang_usia',['0-3 tahun', '4-6 tahun', '7-9 tahun', '10-12 tahun']);
            $table->text('foto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emosi_mental');
    }
};