<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengasuhan', function (Blueprint $table) {
            $table->id('id_pengasuhan');
            $table->string('judul',100);
            $table->longText('deskripsi');
            $table->string('link_video');
            $table->string('rentang_usia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengasuhan');
    }
};