<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIdJabatanTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER jabatan_id BEFORE INSERT ON riwayat_jabatan FOR EACH ROW
            BEGIN
                INSERT INTO jabatan_tbls VALUES (NULL);
                SET NEW.id_jab = CONCAT("JB_", LPAD(LAST_INSERT_ID(), 3, "0"));
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
        DB::unprepared('DROP TRIGGER "jabatan_id"');
    }
};
