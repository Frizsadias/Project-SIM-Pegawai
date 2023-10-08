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
                INSERT INTO profil_pegawai(user_id,name,email) VALUES (NEW.user_id,NEW.name,NEW.email);
                INSERT INTO profil_pegawais(user_id,name,email) VALUES (NEW.user_id,NEW.name,NEW.email);
                INSERT INTO posisi_jabatan(user_id) VALUES (NEW.user_id);
                INSERT INTO posisi_jabatans(user_id) VALUES (NEW.user_id);
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
