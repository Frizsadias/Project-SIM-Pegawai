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
        Schema::create('kedudukan_hukum_id', function (Blueprint $table) {
            $table->id();
            $table->string('kedudukan');
            $table->timestamps();
        });

        DB::table('kedudukan_hukum_id')->insert([
            ['kedudukan' => 'Aktif'],
            ['kedudukan' => 'CLTN'],
            ['kedudukan' => 'Tugas Belajar'],
            ['kedudukan' => 'Pemberhentian Sementara'],
            ['kedudukan' => 'Penerima Uang Tunggu'],
            ['kedudukan' => 'Prajurit Wajib'],
            ['kedudukan' => 'Pejabat Negara'],
            ['kedudukan' => 'Kepala Desa'],
            ['kedudukan' => 'Sedang dlm Proses Banding BAPEK'],
            ['kedudukan' => 'Pegawai Titipan'],
            ['kedudukan' => 'Pengungsi'],
            ['kedudukan' => 'Perpanjangan CLTN'],
            ['kedudukan' => 'PNS yang dinyatakan hilang'],
            ['kedudukan' => 'PNS kena hukuman disiplin'],
            ['kedudukan' => 'Pemindahan dalam rangka penurunan Jabatan'],
            ['kedudukan' => 'Masa Persiapan Pensiun'],
            ['kedudukan' => 'CPNS yang belum menerima SK CPNS'],
            ['kedudukan' => 'Tidak Aktif'],
            ['kedudukan' => 'Diberhentikan'],
            ['kedudukan' => 'Punah'],
            ['kedudukan' => 'Eks PNS Timor Timur'],
            ['kedudukan' => 'TMS Dari Pengadaan'],
            ['kedudukan' => 'Pembatalan NIP'],
            ['kedudukan' => 'Pemberhentian tanpa hak pensiun'],
            ['kedudukan' => 'Pemberhentian dengan hak pensiun'],
            ['kedudukan' => 'Tidak aktif tetapi diusulkan Pensiun'],
            ['kedudukan' => 'Tidak Ikut PUPNS 2015'],
            ['kedudukan' => 'Tindak Pidana/ Tindak Pidana Jabatan'],
            ['kedudukan' => 'Pemblokiran Data PNS'],
            ['kedudukan' => 'Mencapai BUP'],
            ['kedudukan' => 'Pensiun'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kedudukan_hukum_id');
    }
};
