<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanGajiBerkala extends Model
{
    use HasFactory;

    protected $table = 'kenaikan_gaji_berkala';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'golongan_awal',
        'galongan_akhir',
        'gapok_lama',
        'gapok_baru',
        'tgl_sk_kgb',
        'no_sk_kgb',
        'tgl_berlaku',
        'masa_kerja_golongan',
        'masa_kerja',
        'tmt_kgb',
        'dokumen_kgb'
    ];
}
