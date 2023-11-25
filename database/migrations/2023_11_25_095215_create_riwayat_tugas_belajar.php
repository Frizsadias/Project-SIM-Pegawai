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
        Schema::create('riwayat_tugas_belajar', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('jenis_tugas_belajar')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('tingkat_pendidikan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('predikat_akreditasi_jurusan')->nullable();
            $table->string('no_akreditasi_jurusan')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_tugas_belajar');
    }
};
