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
        Schema::create('referensi_pangkat', function (Blueprint $table) {
            $table->id();
            $table->string('ref_pangkat');
            $table->timestamps();
        });

        DB::table('referensi_pangkat')->insert([
            ['ref_pangkat' => 'Dokter'],
            ['ref_pangkat' => 'Perawat'],
            ['ref_pangkat' => 'Paramedis'],
            ['ref_pangkat' => 'Manajemen Rumah Sakit'],
            ['ref_pangkat' => 'Tenaga Keperawatan'],
            ['ref_pangkat' => 'Tenaga Teknis'],
            ['ref_pangkat' => 'Apoteker'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_pangkat');
    }
};
