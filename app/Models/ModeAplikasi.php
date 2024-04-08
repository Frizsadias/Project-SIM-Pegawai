<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeAplikasi extends Model
{
    use HasFactory;

    protected $table = 'mode_aplikasi';
    
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'tema_aplikasi',
        'warna_sistem',
        'warna_sistem_tulisan',
        'warna_mode',
        'tabel_warna',
        'tabel_tulisan_tersembunyi',
        'warna_dropdown_menu',
        'ikon_plugin',
        'bayangan_kotak_header',
        'warna_mode_2',
    ];
}