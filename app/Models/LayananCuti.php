<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananCuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'jenis_cuti',
        'lama_cuti',
        'tanggal_mulai_cuti',
        'tanggal_selesai_cuti',
        'status_pengajuan',
        'dokumen_kelengkapan',
        'jabatan', // Menambahkan kolom jabatan
        'gol_ruang_awal', // Menambahkan kolom golongan/ruang awal
    ];

    public function posisi_jabatan()
    {
        return $this->belongsTo(PosisiJabatan::class, 'jabatan', 'jabatan');
    }
}
