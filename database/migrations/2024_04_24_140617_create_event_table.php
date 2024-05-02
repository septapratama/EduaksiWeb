<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id('id_event');
            $table->uuid('uuid');
            $table->string('nama_event', 50);
            $table->string('deskripsi', 4000);
            $table->string('tempat', 2000);
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
