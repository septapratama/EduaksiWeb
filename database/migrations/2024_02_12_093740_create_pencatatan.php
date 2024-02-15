<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pencatatan', function (Blueprint $table) {
            $table->id('id_pencatatan');
            $table->string('nama_anak');
            $table->integer('umur');
            $table->string('gol_darah',4);
            $table->integer('hasil_gizi');
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pencatatan');
    }
};