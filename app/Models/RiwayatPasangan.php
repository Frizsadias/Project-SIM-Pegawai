<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPasangan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pasangan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
