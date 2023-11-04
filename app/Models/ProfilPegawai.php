<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip',
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'jenis_dokumen',
        'no_dokumen',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'no_hp',
        'no_telp',
        'jenis_pegawai',
        'kedudukan_pns',
        'status_pegawai',
        'tmt_pns',
        'no_seri_karpeg',
        'tmt_cpns',
        'tingkat_pendidikan',
        'pendidikan_terakhir',
        'ruangan',
        'dokumen_ktp'
    ];
}
