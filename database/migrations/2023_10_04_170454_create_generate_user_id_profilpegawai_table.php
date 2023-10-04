<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateUserIdProfilPegawaiTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_profile AFTER UPDATE ON profil_pegawai FOR EACH ROW
            BEGIN
                UPDATE profil_pegawais SET nip=NEW.nip,nama=NEW.nama,gelar_depan=NEW.gelar_depan,
                gelar_belakang=NEW.gelar_belakang,tempat_lahir=NEW.tempat_lahir,
                tanggal_lahir=NEW.tanggal_lahir,jenis_kelamin=NEW.jenis_kelamin,
                agama=NEW.agama,jenis_dokumen=NEW.jenis_dokumen,no_dokumen=NEW.no_dokumen,
                kelurahan=NEW.kelurahan,kecamatan=NEW.kecamatan,kota=NEW.kota,provinsi=NEW.provinsi,
                kode_pos=NEW.kode_pos,no_hp=NEW.no_hp,no_telp=NEW.no_telp,jenis_pegawai=NEW.jenis_pegawai,
                kedudukan_pns=NEW.kedudukan_pns,status_pegawai=NEW.status_pegawai,tmt_pns=NEW.tmt_pns,
                no_seri_karpeg=NEW.no_seri_karpeg,tmt_cpns=NEW.tmt_cpns,tingkat_pendidikan=NEW.tingkat_pendidikan,
                pendidikan_terakhir=NEW.pendidikan_terakhir
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
        DB::unprepared('DROP TRIGGER "update_profile"');
    }
}
