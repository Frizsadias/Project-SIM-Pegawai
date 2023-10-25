<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('posisi_jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('unit_organisasi')->nullable();
            $table->string('unit_organisasi_induk')->nullable();
            $table->string('jenis_jabatan')->nullable();
            $table->string('eselon')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('tmt')->nullable();
            $table->string('lokasi_kerja')->nullable();
            $table->string('gol_ruang_awal')->nullable();
            $table->string('gol_ruang_akhir')->nullable();
            $table->string('tmt_golongan')->nullable();
            $table->string('gaji_pokok')->nullable();
            $table->string('masa_kerja_tahun')->nullable();
            $table->string('masa_kerja_bulan')->nullable();
            $table->string('no_spmt')->nullable();
            $table->string('tanggal_spmt')->nullable();
            $table->string('kppn')->nullable();
            $table->timestamps();
        });

        DB::table('posisi_jabatans')->insert([
            ['user_id' => 'ID_00001'],
            ['user_id' => 'ID_00002']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posisi_jabatans');
    }
};
