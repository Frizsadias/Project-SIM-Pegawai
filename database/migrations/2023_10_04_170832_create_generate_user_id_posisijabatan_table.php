<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateUserIdPosisiJabatanTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_posisijabatan AFTER UPDATE ON posisi_jabatan FOR EACH ROW
            BEGIN
                UPDATE posisi_jabatans SET nip=NEW.nip,unit_organisasi=NEW.unit_organisasi,unit_organisasi_induk=NEW.unit_organisasi_induk,
                jenis_jabatan=NEW.jenis_jabatan,eselon=NEW.eselon,
                jabatan=NEW.jabatan,tmt=NEW.tmt,
                lokasi_kerja=NEW.lokasi_kerja,gol_ruang_awal=NEW.gol_ruang_awal,
                gol_ruang_akhir=NEW.gol_ruang_akhir,
                tmt_golongan=NEW.tmt_golongan,gaji_pokok=NEW.gaji_pokok,
                masa_kerja_tahun=NEW.masa_kerja_tahun,masa_kerja_bulan=NEW.masa_kerja_bulan,
                no_spmt=NEW.no_spmt,tanggal_spmt=NEW.tanggal_spmt,kppn=NEW.kppn
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
        DB::unprepared('DROP TRIGGER "update_posisijabatan"');
    }
}
