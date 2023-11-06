<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan_id';

    protected $fillable = [
        'ruangan',
        'jumlah_tempat_tidur',
    ];
}
