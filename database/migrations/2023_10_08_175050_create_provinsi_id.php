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
        Schema::create('provinsi_id', function (Blueprint $table) {
            $table->id();
            $table->string('ref_provinsi')->nullable();
            $table->timestamps();
        });

        DB::table('provinsi_id')->insert([
            ['ref_provinsi' => 'Aceh'],
            ['ref_provinsi' => 'Bali'],
            ['ref_provinsi' => 'Banten'],
            ['ref_provinsi' => 'Bengkulu'],
            ['ref_provinsi' => 'Gorontalo'],
            ['ref_provinsi' => 'Jakarta'],
            ['ref_provinsi' => 'Jambi'],
            ['ref_provinsi' => 'Jawa Barat'],
            ['ref_provinsi' => 'Jawa Tengah'],
            ['ref_provinsi' => 'Jawa Timur'],
            ['ref_provinsi' => 'Kalimantan Barat'],
            ['ref_provinsi' => 'Kalimantan Selatan'],
            ['ref_provinsi' => 'Kalimantan Tengah'],
            ['ref_provinsi' => 'Kalimantan Timur'],
            ['ref_provinsi' => 'Kalimantan Utara'],
            ['ref_provinsi' => 'Kepulauan Bangka Belitung'],
            ['ref_provinsi' => 'Kepulauan Riau'],
            ['ref_provinsi' => 'Lampung'],
            ['ref_provinsi' => 'Maluku'],
            ['ref_provinsi' => 'Maluku Utara'],
            ['ref_provinsi' => 'Nusa Tenggara Barat'],
            ['ref_provinsi' => 'Nusa Tenggara Timur'],
            ['ref_provinsi' => 'Papua'],
            ['ref_provinsi' => 'Papua Barat'],
            ['ref_provinsi' => 'Riau'],
            ['ref_provinsi' => 'Sulawesi Barat'],
            ['ref_provinsi' => 'Sulawesi Selatan'],
            ['ref_provinsi' => 'Sulawesi Tengah'],
            ['ref_provinsi' => 'Sulawesi Tenggara'],
            ['ref_provinsi' => 'Sulawesi Utara'],
            ['ref_provinsi' => 'Sumatera Barat'],
            ['ref_provinsi' => 'Sumatera Selatan'],
            ['ref_provinsi' => 'Sumatera Utara'],
            ['ref_provinsi' => 'Yogyakarta'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinsi_id');
    }
};
