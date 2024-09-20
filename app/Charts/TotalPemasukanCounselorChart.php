<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\counseling;
use Illuminate\Support\Facades\Auth;

class TotalPemasukanCounselorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $monthlyData = counseling::where('counselor_id',Auth::user()->id)->where('status_counseling','completed')->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
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
        $counselingCounts = [];

        foreach ($monthlyCounts as $monthIndex => $count) {
            $sortedMonths[] = $monthNames[$monthIndex];
            $counselingCounts[] = $count * 125000;
        }
        return $this->chart->barChart()
            ->addData('Pemasukan', $counselingCounts)
            ->setXAxis($sortedMonths);
    }
}
