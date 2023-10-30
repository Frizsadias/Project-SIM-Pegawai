<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjanjianKontrak extends Model
{
    use HasFactory;

    protected $table = 'perjanjian_kontrak';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'nik_blud',
        'pendidikan',
        'tahun_lulus',
        'jabatan',
        'tgl_kontrak',
    ];
}
