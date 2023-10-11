<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    /** page layanan cuti */
    public function indexCuti()
    {
        $cuti = DB::table('cuti')->get();
        return view('layanan.cuti', compact('cuti'));
    }
}
