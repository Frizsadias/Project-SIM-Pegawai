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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('jenis_cuti')->nullable();
            $table->string('lama_cuti')->nullable();
            $table->string('tanggal_mulai_cuti')->nullable();
            $table->string('tanggal_selesai_cuti')->nullable();
            $table->string('dokumen_kelengkapan')->nullable();
            $table->string('dokumen_rekomendasi')->nullable();
            $table->string('status_pengajuan')->nullable();
            $table->string('persetujuan_administrasi')->nullable();
            $table->string('persetujuan_eselon3')->nullable();
            $table->string('persetujuan_eselon4')->nullable();
            $table->string('persetujuan_kepalaruangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
