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
        Schema::create('riwayat_angka_kredit', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('angka_kredit_pertama')->nullable();
            $table->string('integrasi')->nullable();
            $table->string('konversi')->nullable();
            $table->string('bulan_mulai');
            $table->string('tahun_mulai');
            $table->string('bulan_selesai');
            $table->string('tahun_selesai');
            $table->decimal('angka_kredit_utama')->nullable();
            $table->decimal('angka_kredit_penunjang')->nullable();
            $table->decimal('total_angka_kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_angka_kredit');
    }
};
