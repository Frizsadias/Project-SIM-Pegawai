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
        Schema::create('riwayat_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama_organisasi')->nullable();
            $table->string('jabatan_organisasi')->nullable();
            $table->string('tanggal_gabung')->nullable();
            $table->string('tanggal_selesai')->nullable();
            $table->string('no_anggota')->nullable();
            $table->string('dokumen_organisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_organisasi');
    }
};
