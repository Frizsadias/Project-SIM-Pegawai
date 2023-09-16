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
        Schema::create('golongan_id', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_golongan')->nullable();
            $table->timestamps();
        });

        // Menyimpan nama golongan beserta atribut 'nama_golongan'
        $golonganData = [
            ['nama' => 'I/a', 'nama_golongan' => 'Juru Muda'],
            ['nama' => 'I/b', 'nama_golongan' => 'Juru Muda Tingkat I'],
            ['nama' => 'I/c', 'nama_golongan' => 'Juru'],
            ['nama' => 'I/d', 'nama_golongan' => 'Juru Tingkat I'],
            ['nama' => 'II/a', 'nama_golongan' => 'Pengatur Muda'],
            ['nama' => 'II/b', 'nama_golongan' => 'Pengatur Muda Tingkat I'],
            ['nama' => 'II/c', 'nama_golongan' => 'Pengatur'],
            ['nama' => 'II/d', 'nama_golongan' => 'Pengatur Tingkat I'],
            ['nama' => 'III/a', 'nama_golongan' => 'Penata Muda'],
            ['nama' => 'III/b', 'nama_golongan' => 'Penata Muda Tingkat I'],
            ['nama' => 'III/c', 'nama_golongan' => 'Penata'],
            ['nama' => 'III/d', 'nama_golongan' => 'Penata Tingkat I'],
            ['nama' => 'IV/a', 'nama_golongan' => 'Pembina'],
            ['nama' => 'IV/b', 'nama_golongan' => 'Pembina Tingkat I'],
            ['nama' => 'IV/c', 'nama_golongan' => 'Pembina Utama Muda'],
            ['nama' => 'IV/d', 'nama_golongan' => 'Pembina Utama Madya'],
            ['nama' => 'IV/e', 'nama_golongan' => 'Pembina Utama'],
        ];

        // Menggunakan DB::table untuk menghindari masalah jika atribut 'nama_golongan' tidak ada di tabel
        foreach ($golonganData as $data) {
            DB::table('golongan_id')->insert($data);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golongan_id');
    }
};