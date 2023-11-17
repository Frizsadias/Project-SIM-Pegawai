<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateNIPPosisiJabatanTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_nip_posisijabatan AFTER UPDATE ON profil_pegawai FOR EACH ROW
            BEGIN
                UPDATE posisi_jabatan SET nip=NEW.nip
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
        DB::unprepared('DROP TRIGGER "update_nip_posisijabatan"');
    }
};
