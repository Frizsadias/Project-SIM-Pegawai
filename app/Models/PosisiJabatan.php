<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiJabatan extends Model
{
    use HasFactory;
    protected $table = 'posisi_jabatan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
