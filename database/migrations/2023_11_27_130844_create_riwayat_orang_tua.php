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
        Schema::create('riwayat_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('status_hidup')->nullable();
            $table->string('status_pekerjaan_ortu')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tanggal_meninggal')->nullable();
            $table->string('jenis_identitas')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();
            $table->string('dokumen_kk')->nullable();
            $table->string('dokumen_akta_lahir_anak')->nullable();
            $table->string('pas_foto_ayah')->nullable();
            $table->string('pas_foto_ibu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_orang_tua');
    }
};
