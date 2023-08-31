<?php

namespace App\Http\Controllers;

// use App\Charts\AgamaChart;
use App\Charts\GrafikChart;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function index(GrafikChart $chart)
    {
        return view('rekapitulasi.super-admin', ['chart' => $chart->build(), 'grafikAgama' => $chart->grafikAgama(), 'grafikJenisKelamin' => $chart->grafikJenisKelamin()]);
    }
}
