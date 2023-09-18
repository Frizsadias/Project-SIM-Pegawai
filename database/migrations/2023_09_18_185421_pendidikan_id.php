<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendidikan_id', function (Blueprint $table) {
            $table->id();
            $table->string('pendidikan')->nullable();
            $table->string('tk_pendidikan_id')->nullable();
            $table->string('status_pendidikan')->nullable();
            $table->timestamps();
        });

        DB::table('pendidikan_id')->insert([
            ['pendidikan' => 'Sekolah Menengah Pelayaran Pertama', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Mualim Pelayaran terbatas', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Sekolah Pelaut', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Sekolah Pelaut MD', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Sekolah Pelaut Motor Diesel Kapal', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Sekolah Pelaut Juru Motor', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1'],
            ['pendidikan' => 'Sekolah Pelaut Juru Mesin', 'tk_pendidikan_id' => '10', 'status_pendidikan' => '1']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan_id');
    }
};
