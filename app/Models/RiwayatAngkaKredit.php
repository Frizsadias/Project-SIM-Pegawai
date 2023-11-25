<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAngkaKredit extends Model
{
    use HasFactory;

    protected $table = 'riwayat_angka_kredit';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
