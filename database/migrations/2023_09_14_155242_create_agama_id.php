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
        Schema::create('agama_id', function (Blueprint $table) {
            $table->id();
            $table->string('agama')->nullable();
            $table->timestamps();
        });

        DB::table('agama_id')->insert([
            ['agama' => 'Islam'],
            ['agama' => 'Kristen'],
            ['agama' => 'Katholik'],
            ['agama' => 'Hindu'],
            ['agama' => 'Budha'],
            ['agama' => 'Konghucu']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agama_id');
    }
};
