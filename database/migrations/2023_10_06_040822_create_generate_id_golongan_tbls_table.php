<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIdGolonganTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER golongan_id BEFORE INSERT ON riwayat_golongan FOR EACH ROW
            BEGIN
                INSERT INTO golongan_tbls VALUES (NULL);
                SET NEW.id_gol = CONCAT("GL_", LPAD(LAST_INSERT_ID(), 3, "0"));
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER "golongan_id"');
    }
};
