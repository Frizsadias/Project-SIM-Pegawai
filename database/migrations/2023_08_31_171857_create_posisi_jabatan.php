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
        Schema::create('posisi_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('unit_organisasi')->nullable();
            $table->string('unit_organisasi_induk')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('eselon')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('tmt')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->string('gol_ruang_awal')->nullable();
            $table->string('gol_ruang_akhir')->nullable();
            $table->string('tmt_golongan')->nullable();
            $table->string('gaji_pokok')->nullable();
            $table->string('masa_kerja_tahun')->nullable();
            $table->string('masa_kerja_bulan')->nullable();
            $table->string('no_spmt')->nullable();
            $table->string('tanggal_spmt')->nullable();
            $table->string('kppn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisi_jabatan');
    }
};
