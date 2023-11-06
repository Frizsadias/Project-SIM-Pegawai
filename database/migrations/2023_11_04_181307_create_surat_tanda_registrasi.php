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
        Schema::create('surat_tanda_registrasi', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('nomor_reg')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nomor_ijazah')->nullable();
            $table->string('tanggal_lulus')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('kompetensi')->nullable();
            $table->string('no_sertifikat_kompetensi')->nullable();
            $table->string('tgl_berlaku_str')->nullable();
            $table->string('dokumen_str')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_tanda_registrasi');
    }
};
