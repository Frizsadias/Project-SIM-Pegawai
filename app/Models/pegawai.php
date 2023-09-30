<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'user_id',
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
