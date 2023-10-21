<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'tgl_lahir',
        'jk',
        'alamat',
        'avatar',
        'tmpt_lahir',
    ];
}
