<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTandaRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'surat_tanda_registrasi';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'nomor_reg',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor_ijazah',
        'tanggal_lulus',
        'pendidikan_terakhir',
        'kompetensi',
        'no_sertifikat_kompetensi',
        'tgl_berlaku_str',
        'dokumen_str'
    ];
}
