<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;
}