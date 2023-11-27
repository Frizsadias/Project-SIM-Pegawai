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
        Schema::create('kenaikan_gaji_berkala', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('golongan_awal')->nullable();
            $table->string('golongan_akhir')->nullable();
            $table->string('gapok_lama')->nullable();
            $table->string('gapok_baru')->nullable();
            $table->string('tgl_sk_kgb')->nullable();
            $table->string('no_sk_kgb')->nullable();
            $table->string('tgl_berlaku')->nullable();
            $table->string('masa_kerja_golongan')->nullable();
            $table->string('masa_kerja')->nullable();
            $table->string('tmt_kgb')->nullable();
            $table->string('dokumen_kgb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kenaikan_gaji_berkala');
    }
};
