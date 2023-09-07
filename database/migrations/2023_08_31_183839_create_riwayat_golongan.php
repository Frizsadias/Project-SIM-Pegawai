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
        Schema::create('riwayat_golongan', function (Blueprint $table) {
            $table->id();
            $table->string('golongan')->nullable();
            $table->string('jenis_kenaikan_pangkat')->nullable();
            $table->string('masa_kerja_golongan_tahun')->nullable();
            $table->string('masa_kerja_golongan_bulan')->nullable();
            $table->string('tmt_golongan')->nullable();
            $table->string('no_teknis_bkn')->nullable();
            $table->string('tanggal_teknis_bkn')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tanggal_sk')->nullable();
            $table->string('dokumen_skkp')->nullable();
            $table->string('dokumen_teknis_kp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_golongan');
    }
};
