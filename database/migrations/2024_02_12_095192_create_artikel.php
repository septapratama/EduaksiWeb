<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->uuid('uuid');
            $table->string('judul');
            $table->longText('deskripsi');
            $table->enum('kategori', ['disi', 'emotal', 'nutrisi', 'pengasuhan']);
            $table->string('link_video')->nullable();
            $table->text('foto');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};