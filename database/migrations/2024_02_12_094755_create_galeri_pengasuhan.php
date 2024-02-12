<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_pengasuhan', function (Blueprint $table) {
            $table->id('id_galeri_pengasuhan');
            $table->text('foto');
            $table->unsignedBigInteger('id_pengasuhan');
            $table->foreign('id_pengasuhan')->references('id_pengasuhan')->on('pengasuhan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_pengasuhan');
    }
};