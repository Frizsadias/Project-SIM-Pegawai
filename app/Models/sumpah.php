<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sumpah extends Model
{
    use HasFactory;
    protected $table = 'sumpah_id';

    protected $fillable = [
        'sumpah',
    ];
}
