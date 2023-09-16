<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_diklat_id', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_diklat')->nullable();
            $table->string('jenis_kursus_sertifikat')->nullable();
            $table->timestamps();
        });

        DB::table('jenis_diklat_id')->insert([
            ['jenis_diklat' => 'Diklat Fungsional', 'jenis_kursus_sertifikat' => 'F'],
            ['jenis_diklat' => 'Diklat Teknis', 'jenis_kursus_sertifikat' => 'T'],
            ['jenis_diklat' => 'Diklat Manajerial', 'jenis_kursus_sertifikat' => ''],
            ['jenis_diklat' => 'Diklat Sosial Kultural', 'jenis_kursus_sertifikat' => ''],
            ['jenis_diklat' => 'Sosialisasi', 'jenis_kursus_sertifikat' => 'P'],
            ['jenis_diklat' => 'Bimbingan Teknis', 'jenis_kursus_sertifikat' => 'P'],
            ['jenis_diklat' => 'Seminar', 'jenis_kursus_sertifikat' => 'P'],
            ['jenis_diklat' => 'Magang', 'jenis_kursus_sertifikat' => 'P'],
            ['jenis_diklat' => 'Diklat Struktural', 'jenis_kursus_sertifikat' => ''],
            ['jenis_diklat' => 'Workshop', 'jenis_kursus_sertifikat' => 'P'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_diklat_id');
    }
};
