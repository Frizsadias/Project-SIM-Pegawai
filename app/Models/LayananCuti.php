<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananCuti extends Model
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


        $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('nip')->nullable();
            $table->string('jenis_cuti')->nullable();
            $table->string('lama_cuti')->nullable();
            $table->string('tanggal_mulai_cuti')->nullable();
            $table->string('tanggal_selesai_cuti')->nullable();
            $table->string('dokumen_kelengkapan')->nullable();
            $table->string('dokumen_rekomendasi')->nullable();
            $table->string('status_pengajuan')->nullable();
    ];
}
