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
        Schema::create('kinerja', function (Blueprint $table) {
            $table->id();
            $table->string('tahun')->nullable();
            $table->string('hasil_kinerja')->nullable();
            $table->string('rating_hasil_kinerja')->nullable();
            $table->string('perilaku_kerja')->nullable();
            $table->string('rating_perilaku_kerja')->nullable();
            $table->string('kuadran_kinerja')->nullable();
            $table->string('rating_kuadran_kinerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinerja');
    }
};
