<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class RiwayatPendidikanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // $riwayatPendidikan = RiwayatPendidikan::get();
        // $data = [
        //     $riwayatPendidikan->where('tingkat', 'SD')->count(),
        //     $riwayatPendidikan->where('tingkat', 'SMP')->count(),
        //     $riwayatPendidikan->where('tingkat', 'SMA')->count(),
        //     $riwayatPendidikan->where('tingkat', 'S1')->count(),
        //     $riwayatPendidikan->where('tingkat', 'S2')->count(),
        // ];

        // $label = [
        //     'SD',
        //     'SMP',
        //     'SMA',
        //     'S1',
        //     'S2',
        // ];

        return $this->chart->pieChart()
            ->setTitle('Riwayat Pendidikan')
            ->setSubtitle('')
            ->addData([40, 50, 30, 22, 15])
            ->setLabels(['SD', 'SMP', 'SMA', 'S1', 'S2']);
    }
}
