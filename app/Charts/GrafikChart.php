<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\ProfilPegawai;
use App\Models\PosisiJabatan;
use DB;

class GrafikChart
{
    protected $chart;
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $dataPendidikan = ProfilPegawai::selectRaw('COALESCE(pendidikan_terakhir,"Tidak Diketahui")as pendidikan_terakhir, COUNT(*) as jumlahPendidikan')
            ->groupBy('pendidikan_terakhir')
            ->get();

        $jumlahDataPendidikan = $dataPendidikan->pluck('jumlahPendidikan')->toArray();
        $labelsPendidikan = $dataPendidikan->pluck('pendidikan_terakhir')->toArray();

        return $this->chart->pieChart()
            ->setTitle('')
            ->addData($jumlahDataPendidikan)
            ->setLabels($labelsPendidikan);
    }

    public function grafikAgama(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $dataAgama = ProfilPegawai::selectRaw('COALESCE(agama, "Tidak Diketahui") as agama, COUNT(*) as jumlahAgama')
        ->groupBy('agama')
        ->get();
        $labelsAgama = $dataAgama->pluck('agama')->toArray();
        $jumlahDataAgama = $dataAgama->pluck('jumlahAgama')->toArray();
        return $this->chart->donutChart()
            ->setSubtitle('')
            ->addData($jumlahDataAgama)
            ->setLabels($labelsAgama);
    }

    public function grafikJenisKelamin(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $dataJenisKelamin = ProfilPegawai::selectRaw('COALESCE(jenis_kelamin, "Tidak Diketahui") as jenis_kelamin, COUNT(*) as jumlahJenisKelamin')
            ->groupBy('jenis_kelamin')
            ->pluck('jumlahJenisKelamin', 'jenis_kelamin')
            ->toArray();

        $labelsJenisKelamin = array_keys($dataJenisKelamin);
        $jumlahDataJenisKelamin = array_values($dataJenisKelamin);

        return $this->chart->barChart()
            ->setSubtitle('')
            ->addData('Jumlah Data', $jumlahDataJenisKelamin)
            ->setLabels($labelsJenisKelamin);
    }
    
    public function grafikPangkat(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $dataPangkat = PosisiJabatan::selectRaw('COALESCE(jabatan, "Tidak Diketahui") as jabatan, COUNT(*) as jumlahPangkat')
            ->groupBy('jabatan')
            ->get();

        $jumlahDataPangkat = $dataPangkat->pluck('jumlahPangkat')->toArray();
        $labelsPangkat = $dataPangkat->pluck('jabatan')->toArray();

        return $this->chart->areaChart()
            ->setTitle('')
            ->addData('Jumlah Data', $jumlahDataPangkat)
            ->setXAxis($labelsPangkat);
    }
}
