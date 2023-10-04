<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHapusProfilPegawaisTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER hapus_profil2 AFTER DELETE ON users FOR EACH ROW
            BEGIN
                DELETE FROM profil_pegawais
            WHERE OLD.user_id = user_id;
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
        DB::unprepared('DROP TRIGGER "hapus_profil2"');
    }
}
