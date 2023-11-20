<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateNIPNIKTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_nip_nik_users AFTER UPDATE ON profil_pegawai FOR EACH ROW
            BEGIN
                UPDATE users SET nip=NEW.nip,no_dokumen=NEW.no_dokumen
            WHERE id=OLD.id;
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
        DB::unprepared('DROP TRIGGER "update_nip_nik_users"');
    }
};
