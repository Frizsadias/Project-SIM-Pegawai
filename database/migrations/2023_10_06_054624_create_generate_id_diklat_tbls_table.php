<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIdDiklatTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER diklat_id BEFORE INSERT ON riwayat_diklat FOR EACH ROW
            BEGIN
                INSERT INTO diklat_tbls VALUES (NULL);
                SET NEW.id_dik = CONCAT("DK_", LPAD(LAST_INSERT_ID(), 3, "0"));
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
        DB::unprepared('DROP TRIGGER "diklat_id"');
    }
};
