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
        Schema::create('peta_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('pdf_peta')->nullable();
            $table->timestamps();
        });

        DB::table('peta_jabatan')->insert([
            ['id' => '1', 'pdf_peta' => 'STRUKTUR ORGANISASI RSUD CARUBAN.pdf']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peta_jabatan');
    }
};
