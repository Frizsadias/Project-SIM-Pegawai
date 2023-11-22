<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPMK extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pmk';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
