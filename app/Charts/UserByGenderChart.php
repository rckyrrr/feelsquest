<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;

class UserByGenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $maleCount = User::where('gender', 'Pria')->count();
        $femaleCount = User::where('gender', 'Wanita')->count();
        return $this->chart->pieChart()
            ->addData([$maleCount, $femaleCount])
            ->setLabels(['Pria','Wanita']);
    }
}
