<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakKerja extends Model
{
    use HasFactory;

    protected $table = 'kontrak_kerja';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'nik_blud',
        'pendidikan',
        'tahun_lulus',
        'jabatan'
    ];
    
    public function posisi_jabatan()
    {
        return $this->belongsTo(PosisiJabatan::class, 'jabatan', 'jabatan');
    }
}
