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
        Schema::create('status_id', function (Blueprint $table) {
            $table->id();
            $table->string('ref_status')->nullable();
            $table->timestamps();
        });

        DB::table('status_id')->insert([
            ['ref_status' => 'PNS'],
            ['ref_status' => 'BLUD'],
            ['ref_status' => 'PPPK'],
            ['ref_status' => 'Non ASN'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_id');
    }
};
