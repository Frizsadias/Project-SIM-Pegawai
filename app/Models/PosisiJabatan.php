<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiJabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'unit_organisasi',
        'unit_organisasi_induk',
        'jenis_jabatan',
        'eselon',
        'jabatan',
        'tmt',
        'lokasi_kerja',
        'gol_ruang_awal',
        'gol_ruang_akhir',
        'tmt_golongan',
        'gaji_pokok',
        'masa_kerja_tahun',
        'masa_kerja_bulan',
        'no_spmt', 
        'tanggal_spmt',
        'kppn',

    ];
}
