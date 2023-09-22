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
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('satuan_kerja')->nullable();
            $table->string('satuan_kerja_induk')->nullable();
            $table->string('unit_organisasi')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tanggal_sk')->nullable();
            $table->string('tmt_jabatan')->nullable();
            $table->string('tmt_pelantikan')->nullable();
            $table->string('dokumen_sk_jabatan')->nullable();
            $table->string('dokumen_pelantikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
};
