<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;

class UserChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }


    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $monthlyData = User::where('user_type','user')->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
        ->groupBy('month')
        ->get();
        $monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $monthlyCounts = array_fill(0, 12, 0);

        foreach ($monthlyData as $data) {
            $monthIndex = $data->month - 1;
            $monthlyCounts[$monthIndex] =  $data->count;
        }

        $sortedMonths = [];
        $userCounts = [];

        foreach ($monthlyCounts as $monthIndex => $count) {
            $sortedMonths[] = $monthNames[$monthIndex];
            $userCounts[] = $count;
        }

        return $this->chart->barChart()
            ->addData('Klien', $userCounts)
            ->setXAxis($sortedMonths);



    }


}
