<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateUserIdUsersTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER profil_posisi AFTER INSERT ON users FOR EACH ROW
            BEGIN
                INSERT INTO profil_pegawai(name,user_id,email,nip,no_dokumen) VALUES (NEW.name,NEW.user_id,NEW.email,NEW.nip,NEW.no_dokumen);
                INSERT INTO profil_pegawais(name,user_id,email,nip,no_dokumen) VALUES (NEW.name,NEW.user_id,NEW.email,NEW.nip,NEW.no_dokumen);
                INSERT INTO posisi_jabatan(user_id,nip) VALUES (NEW.user_id,NEW.nip);
                INSERT INTO posisi_jabatans(user_id,nip) VALUES (NEW.user_id,NEW.nip);
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
        DB::unprepared('DROP TRIGGER "profil_posisi"');
    }
}
