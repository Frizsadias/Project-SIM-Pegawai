<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPenghargaan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penghargaan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
