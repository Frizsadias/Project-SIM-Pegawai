<?php

namespace App\Http\Controllers;

use App\Charts\RiwayatPendidikanChart;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function index(RiwayatPendidikanChart $chart)
    {
        return view('users.index', ['chart' => $chart->build()]);
    }
}
