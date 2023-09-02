<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    protected $fillable = [
        'tingkat_pendidikan',
        'pendidikan',
        'tahun_lulus',
        'no_ijazah',
        'nama_sekolah',
        'gelar_depan',
        'gelar_belakang',
        'jenis_pendidikan',
        'dokumen',
    ];
}
