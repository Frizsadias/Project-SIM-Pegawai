<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class GrafikChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            // ->setTitle('Riwayat Pendidikan')
            ->setSubtitle('')
            ->addData([40, 50, 30, 22])
            ->setLabels(['SLPT', 'SLTA', 'Diploma I', 'Diploma II']);
    }

    public function grafikAgama(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        return $this->chart->donutChart()
            // ->setTitle('Grafik Pegawai Berdasarkan Agama')
            ->setSubtitle('')
            ->addData([100, 50, 5, 1, 3])
            ->setLabels(['Islam', 'Kristen', 'Budha', 'Hindu', 'Konghuchu']);
    }

    public function grafikJenisKelamin(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            // ->setTitle('Grafik Pegawai Berdasarkan Jenis Kelamin')
            ->setSubtitle('')
            ->addData('Jenis Kelamin', [110, 125])
            ->setLabels(['Laki-Laki', 'Perempuan']);
    }

    public function grafikPangkat(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        return $this->chart->areaChart()
            // ->setTitle('Jumlah Pegawai Berdasarkan Pangkat')
            ->setSubtitle('')
            ->addData('Pangkat', [8, 5, 7, 10])
            ->setXAxis(['Pelaksana', 'Staf Muda I', 'Staf Madya I', 'Pelaksana Muda']);
    }
}
