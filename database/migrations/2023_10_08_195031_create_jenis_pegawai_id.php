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
        Schema::create('jenis_pegawai_id', function (Blueprint $table) {
            $table->id();
            $table->string('id_jenis_pegawai');
            $table->string('jenis_pegawai');
            $table->timestamps();
        });

        DB::table('jenis_pegawai_id')->insert([
                ['id_jenis_pegawai' => '1', 'jenis_pegawai' => 'Umum'],
                ['id_jenis_pegawai' => '2', 'jenis_pegawai' => 'Honorer'],
                ['id_jenis_pegawai' => '3', 'jenis_pegawai' => 'Sekdes'],
                ['id_jenis_pegawai' => '4', 'jenis_pegawai' => 'Alih Status'],
                ['id_jenis_pegawai' => '5', 'jenis_pegawai' => 'Khusus Dokter'],
                ['id_jenis_pegawai' => '6', 'jenis_pegawai' => 'Tenaga Ahli Tertentu/Khusus'],
                ['id_jenis_pegawai' => '7', 'jenis_pegawai' => 'Khusus SM-3T'],
                ['id_jenis_pegawai' => '8', 'jenis_pegawai' => 'Khusus Disabilitas'],
                ['id_jenis_pegawai' => '9', 'jenis_pegawai' => 'Khusus Putra Putri Terbaik'],
                ['id_jenis_pegawai' => 'A', 'jenis_pegawai' => 'D1 STAN'],
                ['id_jenis_pegawai' => 'B', 'jenis_pegawai' => 'DIASPORA'],
                ['id_jenis_pegawai' => 'C', 'jenis_pegawai' => 'PPPK'],
                ['id_jenis_pegawai' => 'D', 'jenis_pegawai' => 'Guru Garis Depan'],
                ['id_jenis_pegawai' => 'G', 'jenis_pegawai' => 'Tenaga Guru'],
                ['id_jenis_pegawai' => 'I', 'jenis_pegawai' => 'Ikatan Dinas'],
                ['id_jenis_pegawai' => 'K', 'jenis_pegawai' => 'PTT Kemenkes'],
                ['id_jenis_pegawai' => 'L', 'jenis_pegawai' => 'THLTB Penyuluh Pertanian'],
                ['id_jenis_pegawai' => 'O', 'jenis_pegawai' => 'Untuk Olahragawan Berprestasi dan Pelatih Berprestasi'],
                ['id_jenis_pegawai' => 'P', 'jenis_pegawai' => 'Khusus Putra/I Papua'],
                ['id_jenis_pegawai' => 'S', 'jenis_pegawai' => 'STTD Kementrian Perhubungan'],
                ['id_jenis_pegawai' => 'U', 'jenis_pegawai' => 'BLUD'],
                ['id_jenis_pegawai' => 'V', 'jenis_pegawai' => 'Non ASN'],
                ['id_jenis_pegawai' => 'W', 'jenis_pegawai' => 'ASN'],
                ['id_jenis_pegawai' => 'X', 'jenis_pegawai' => 'CPNS']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pegawai_id');
    }
};
