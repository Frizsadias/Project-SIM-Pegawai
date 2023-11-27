<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatOrangTua extends Model
{
    use HasFactory;

    protected $table = 'riwayat_orang_tua';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
