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
            CREATE TRIGGER sinkronisasi_data AFTER INSERT ON users FOR EACH ROW
            BEGIN
                INSERT INTO mode_aplikasi(name,user_id,email,tema_aplikasi) VALUES (NEW.name,NEW.user_id,NEW.email,NEW.tema_aplikasi);
                INSERT INTO daftar_pegawai(name,user_id,nip,role_name,avatar,ruangan) VALUES (NEW.name,NEW.user_id,NEW.nip,NEW.role_name,NEW.avatar,NEW.ruangan);
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
        DB::unprepared('DROP TRIGGER "sinkronisasi_data"');
    }
}