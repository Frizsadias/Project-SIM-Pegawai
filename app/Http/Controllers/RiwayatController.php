<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Riwayat;

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
    public function index()
    {
        return view('riwayat.riwayat-pendidikan');
    }

    public function r_golongan()
    {
        return view('riwayat.riwayat-golongan');
    }

    public function r_jabatan()
    {
        return view('riwayat.riwayat-jabatan');
    }

    public function r_diklat()
    {
        return view('riwayat.riwayat-diklat');
    }
}
