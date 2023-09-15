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
        Schema::create('jenis_jabatan_id', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->timestamps();
        });

        DB::table('jenis_jabatan_id')->insert([
            ['nama' => 'Jabatan Struktural'],
            ['nama' => 'Jabatan Fungsional Tertentu'],
            ['nama' => 'Jabatan Rangkap (Struktural dan Fungsional)'],
            ['nama' => 'Jabatan Fungsional Umum'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_jabatan_id');
    }
};
