<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'jenis_cuti',
        'lama_cuti',
        'tanggal_mulai_cuti',
        'tanggal_selesai_cuti',
        'dokumen_kelengkapan',
        'dokumen_rekomendasi',
    ];
}
