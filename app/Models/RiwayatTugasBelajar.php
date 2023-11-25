<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTugasBelajar extends Model
{
    use HasFactory;

    protected $table = 'riwayat_tugas_belajar';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
