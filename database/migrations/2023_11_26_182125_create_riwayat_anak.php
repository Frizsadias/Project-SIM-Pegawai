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
        Schema::create('riwayat_anak', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('orang_tua')->nullable();
            $table->string('status_pekerjaan_anak')->nullable();
            $table->string('nama_anak')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('status_anak')->nullable();
            $table->string('jenis_dokumen')->nullable();
            $table->string('no_dokumen')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_hidup')->nullable();
            $table->string('no_akta_kelahiran')->nullable();
            $table->string('dokumen_akta_kelahiran')->nullable();
            $table->string('pas_foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_anak');
    }
};
