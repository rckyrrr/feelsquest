<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
class TotalAnalisisChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $monthlyData = TestResult::where('counselor_id',Auth::user()->id)->where('status_result','completed')->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
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
        $TestAnalisisCounts = [];

        foreach ($monthlyCounts as $monthIndex => $count) {
            $sortedMonths[] = $monthNames[$monthIndex];
            $TestAnalisisCounts[] = $count;
        }
        return $this->chart->barChart()
            ->addData('Analisis', $TestAnalisisCounts)
            ->setXAxis($sortedMonths);
    }
}
