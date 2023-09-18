<?php

namespace App\Http\Controllers;

use App\Charts\GrafikChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(GrafikChart $chart)
    {
        return view('dashboard.Halaman-super-admin', ['chart' => $chart->build(), 'grafikAgama' => $chart->grafikAgama(), 'grafikJenisKelamin' => $chart->grafikJenisKelamin(), 'grafikPangkat' => $chart->grafikPangkat()]);
    }
}
