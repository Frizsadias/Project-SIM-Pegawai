<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAnak extends Model
{
    use HasFactory;

    protected $table = 'riwayat_anak';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
