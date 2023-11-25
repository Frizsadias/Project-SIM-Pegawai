<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatHukumanDisiplin extends Model
{
    use HasFactory;

    protected $table = 'riwayat_hukuman_disiplin';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
