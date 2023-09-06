<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_jabatan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
