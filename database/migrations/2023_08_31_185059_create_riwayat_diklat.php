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
        Schema::create('riwayat_diklat', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_diklat')->nullable();
            $table->string('nama_diklat')->nullable();
            $table->string('institusi_penyelenggara')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('tanggal_selesai')->nullable();
            $table->string('tahun_diklat')->nullable();
            $table->string('durasi_jam')->nullable();
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_diklat');
    }
};
