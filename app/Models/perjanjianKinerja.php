<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perjanjianKinerja extends Model
{
    use HasFactory;

    protected $table = 'perjanjian_kinerja';

    protected $fillable = [
        'user_id',
        'name',
        'nip',
        'jabatan',
        'jenis_jabatan',
        'bentuk_perjanjian',
    ];
}
