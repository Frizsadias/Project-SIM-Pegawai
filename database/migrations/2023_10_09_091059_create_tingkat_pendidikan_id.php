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
        Schema::create('tingkat_pendidikan_id', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat_pendidikan')->nullable();
            $table->timestamps();
        });

        DB::table('tingkat_pendidikan_id')->insert([
            ['tingkat_pendidikan' => 'SD'],
            ['tingkat_pendidikan' => 'SMP'],
            ['tingkat_pendidikan' => 'SMA'],
            ['tingkat_pendidikan' => 'Diploma I'],
            ['tingkat_pendidikan' => 'Diploma II'],
            ['tingkat_pendidikan' => 'Diploma III'],
            ['tingkat_pendidikan' => 'S1'],
            ['tingkat_pendidikan' => 'S2'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tingkat_pendidikan_id');
    }
};
