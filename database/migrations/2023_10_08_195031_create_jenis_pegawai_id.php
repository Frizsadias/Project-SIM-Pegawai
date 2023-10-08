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
            ['id_jenis_pegawai' => '1', 'jenis_pegawai' => 'UMUM'],
            ['id_jenis_pegawai' => '2', 'jenis_pegawai' => 'HONORER'],
            ['id_jenis_pegawai' => '3', 'jenis_pegawai' => 'SEKDES'],
            ['id_jenis_pegawai' => '4', 'jenis_pegawai' => 'ALIH STATUS'],
            ['id_jenis_pegawai' => '5', 'jenis_pegawai' => 'KHUSUS DOKTER'],
            ['id_jenis_pegawai' => '6', 'jenis_pegawai' => 'TENAGA AHLI TERTENTU/KHUSUS'],
            ['id_jenis_pegawai' => '7', 'jenis_pegawai' => 'KHUSUS SM-3T'],
            ['id_jenis_pegawai' => '8', 'jenis_pegawai' => 'KHUSUS DISABILITAS'],
            ['id_jenis_pegawai' => '9', 'jenis_pegawai' => 'KHUSUS PUTRA PUTRI TERBAIK'],
            ['id_jenis_pegawai' => 'A', 'jenis_pegawai' => 'D1 STAN'],
            ['id_jenis_pegawai' => 'B', 'jenis_pegawai' => 'DIASPORA'],
            ['id_jenis_pegawai' => 'C', 'jenis_pegawai' => 'PPPK'],
            ['id_jenis_pegawai' => 'D', 'jenis_pegawai' => 'GURU GARIS DEPAN'],
            ['id_jenis_pegawai' => 'G', 'jenis_pegawai' => 'TENAGA GURU'],
            ['id_jenis_pegawai' => 'I', 'jenis_pegawai' => 'IKATAN DINAS'],
            ['id_jenis_pegawai' => 'K', 'jenis_pegawai' => 'PTT KEMENKES'],
            ['id_jenis_pegawai' => 'L', 'jenis_pegawai' => 'THLTB PENYULUH PERTANIAN'],
            ['id_jenis_pegawai' => 'O', 'jenis_pegawai' => 'UNTUK OLAHRAGAWAN BERPRESTASI DAN PELATIH BERPRESTASI'],
            ['id_jenis_pegawai' => 'P', 'jenis_pegawai' => 'KHUSUS PUTRA/I PAPUA'],
            ['id_jenis_pegawai' => 'S', 'jenis_pegawai' => 'STTD KEMENTRIAN PERHUBUNGAN'],
            ['id_jenis_pegawai' => 'U', 'jenis_pegawai' => 'BLUD'],
            ['id_jenis_pegawai' => 'V', 'jenis_pegawai' => 'NON ASN'],
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
