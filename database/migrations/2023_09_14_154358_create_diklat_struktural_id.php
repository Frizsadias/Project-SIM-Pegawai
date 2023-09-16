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
        Schema::create('latihan_struktural_id', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        DB::table('jenis_kawin_id')->insert([
            ['nama' => 'SEPADA'],
            ['nama' => 'SEPALA/ADUM/DIKLAT TK.IV'],
            ['nama' => 'SEPADYA/SPAMA/DIKLAT PIM TK.III'],
            ['nama' => 'SPAMEN/SESPA/SESPANAS/DIKLAT PIM TK.II'],
            ['nama' => 'SEPATI/DIKLAT PIM TK.I'],
            ['nama' => 'SESPIM'],
            ['nama' => 'SESPATI'],
            ['nama' => 'Diklat Struktural Lainnya'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_struktural_id');
    }
};
