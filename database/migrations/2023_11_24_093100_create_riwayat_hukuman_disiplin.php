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
        Schema::create('riwayat_hukuman_disiplin', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('kategori_hukuman')->nullable();
            $table->string('tingkat_hukuman')->nullable();
            $table->string('jenis_hukuman')->nullable();
            $table->string('no_sk_hukuman')->nullable();
            $table->string('no_peraturan')->nullable();
            $table->string('alasan')->nullable();
            $table->string('tanggal_sk_hukuman')->nullable();
            $table->string('masa_hukuman_tahun')->nullable();
            $table->string('tmt_hukuman')->nullable();
            $table->string('masa_hukuman_bulan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('dokumen_sk_hukuman')->nullable();
            $table->string('dokumen_sk_pengaktifan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_hukuman_disiplin');
    }
};
