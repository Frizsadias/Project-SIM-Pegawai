<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPendidikan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Session;

class RiwayatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     /** view riwayat pendidikan page */
     public function pendidikan()
    {
        $riwayatPendidikan = RiwayatPendidikan::all();
        return view('riwayat.riwayat-pendidikan', compact('riwayatPendidikan'));
    }

    /** view riwayat golongan page */
    public function golongan()
    {
        return view('riwayat.riwayat-golongan');
    }

    /** view riwayat jabatan page */
    public function jabatan()
    {
        return view('riwayat.riwayat-jabatan');
    }

    /** view riwayat diklat page */
    public function diklat()
    {
        return view('riwayat.riwayat-diklat');
    }
}
