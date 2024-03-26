<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'nip',
        'role_name',
        'avatar',
        'pendidikan_terakhir',
        'no_hp',
        'ruangan',
        'kedudukan_pns',
        'jenis_pegawai',
        'jabatan',
        'gol_ruang_awal',
        'gol_ruang_akhir',
        'tempat_lahir',
        'tanggal_lahir',
        'tingkat_pendidikan',
        'jenis_kelamin'
    ];
}