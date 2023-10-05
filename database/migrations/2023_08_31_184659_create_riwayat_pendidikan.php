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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pend');
            $table->string('user_id')->nullable();
            $table->string('ting_ped')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('gelar_depan_pend')->nullable();
            $table->string('gelar_belakang_pend')->nullable();
            $table->string('jenis_pendidikan')->nullable();
            $table->string('dokumen_transkrip')->nullable();
            $table->string('dokumen_ijazah')->nullable();
            $table->string('dokumen_gelar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
