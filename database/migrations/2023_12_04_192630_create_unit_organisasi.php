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
        Schema::create('unit_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('unor_id');
            $table->string('unor_nama');
            $table->timestamps();
        });

        $unorData = [
            ['unor_id' => 'A5EB03E8964DF6A0E040640A040252AD', 'unor_nama' => 'Seksi Pelayanan Keperawatan - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E8962DF6A0E040640A040252AD', 'unor_nama' => 'Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => '8ae4829b35e7b4810135ebafa53071f5', 'unor_nama' => 'Seksi Penunjang Non Medik - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89649F6A0E040640A040252AD', 'unor_nama' => 'Seksi Pelayanan Medik - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => '8ae4829b35e7b4810135ebaeb28071cd', 'unor_nama' => 'Seksi Penunjang Medik - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89641F6A0E040640A040252AD', 'unor_nama' => 'Seksi Verifikasi dan Akuntansi - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89647F6A0E040640A040252AD', 'unor_nama' => 'Bidang Pelayanan - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E8963DF6A0E040640A040252AD', 'unor_nama' => 'Sub Bagian Umum - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E8963FF6A0E040640A040252AD', 'unor_nama' => 'Seksi Anggaran dan Mobilisasi Dana - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89645F6A0E040640A040252AD', 'unor_nama' => 'Sub Bagian Perencanaan Informasi - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89643F6A0E040640A040252AD', 'unor_nama' => 'Sub Bagian Kepegawaian - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E8963BF6A0E040640A040252AD', 'unor_nama' => 'Bidang Keuangan - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E89639F6A0E040640A040252AD', 'unor_nama' => 'Bagian Tata Usaha - Rumah Sakit Umum Daerah Caruban'],
            ['unor_id' => 'A5EB03E8964BF6A0E040640A040252AD', 'unor_nama' => 'Bidang Penunjang - Rumah Sakit Umum Daerah Caruban'],
        ];

        foreach ($unorData as $data) {
            DB::table('unit_organisasi')->insert($data);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_organisasi');
    }
};
