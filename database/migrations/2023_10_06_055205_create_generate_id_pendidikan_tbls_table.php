<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIdPendidikanTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER pendidikan_id BEFORE INSERT ON riwayat_pendidikan FOR EACH ROW
            BEGIN
                INSERT INTO pendidikan_tbls VALUES (NULL);
                SET NEW.id_pend = CONCAT("PD_", LPAD(LAST_INSERT_ID(), 3, "0"));
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
        DB::unprepared('DROP TRIGGER "pendidikan_id"');
    }
};
