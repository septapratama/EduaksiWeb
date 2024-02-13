<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_nutrisi', function (Blueprint $table) {
            $table->id('id_galeri_nutrisi');
            $table->text('foto');
            $table->unsignedBigInteger('id_nutrisi');
            $table->foreign('id_nutrisi')->references('id_nutrisi')->on('nutrisi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_nutrisi');
    }
};