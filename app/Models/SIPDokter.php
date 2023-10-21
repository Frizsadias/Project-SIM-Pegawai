<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SIPDokter extends Model
{
    use HasFactory;

    protected $table = 'sip_spk_dokter';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'unit_kerja',
        'nomor_sip',
        'tanggal_terbit',
        'tanggal_berlaku',
        'sip_spk_jabatan',
        'jenis_dokumen',
        'ruangan',
        'dokumen_sip',
    ];
}
