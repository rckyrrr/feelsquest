@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Klien</b>
                <h1 class="fw-bold">{{ $totalKlien->count() }}</h1>

            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Top Performer</b>
                @if ($mostCounselor)
                    <h1 class="fw-bold">{{ $mostCounselor->counselor->name }}</h1>
                @else
                    <h1 class="fw-bold">Tidak ada</h1>
                @endif

            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Paket Terlaris</b>
                @if ($mostPackage)
                    <h1 class="fw-bold">{{ $mostPackage->package->name }}</h1>
                @else
                    <h1 class="fw-bold">Tidak ada</h1>
                @endif

            </div>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <div class="col-md-8 mx-auto">
                    <b>User Berdasarkan Gender</b>
                    {!! $userbyGenderChart->container() !!}
                </div>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <div class="col-md-8 mx-auto">
                    <b>Gross Profit</b>
                    <div id="grossProfit"></div>
                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                    <script>
                        var grossProfit = new ApexCharts(document.querySelector("#grossProfit"), {
                            chart: {
                                type: 'bar', // Jenis grafik (misalnya line, bar, pie)
                                height: 350, // Tinggi grafik dalam pixel
                                // ... tambahkan opsi lain yang diperlukan
                            },
                            series: [{
                                name: 'Total Amount', // Nama seri data
                                data: [
                                    @foreach ($allMonthsGross as $month)
                                        {
                                            x: '{{ \Carbon\Carbon::parse($month)->format('F Y') }}', // Label bulan
                                            y: {{ $grossProfit->where('transaction_month', $month)->first()->total_amount ?? 0 }} // Nilai total_amount atau 0 jika tidak ada data
                                        },
                                    @endforeach
                                ] // Nilai-nilai seri data
                            }],
                            xaxis: {
                                type: 'category' // Jenis axis x sebagai kategori
                            },
                            // ... tambahkan opsi grafik lainnya
                        });

                        grossProfit.render();
                    </script>
                </div>
            </div>

            <div class="p-5 col-md-8 mx-auto bg-white">
                <b>Net Profit</b>
                <div id="netProfit"></div>
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var netProfitData = [
                            @foreach ($netProfits as $netProfit)
                                {
                                    x: '{{ \Carbon\Carbon::parse($netProfit['transaction_month'])->format('F Y') }}', // Label bulan
                                    y: {{ $netProfit['net_profit'] }} // Nilai net profit
                                },
                            @endforeach
                        ];

                        var netProfitChart = new ApexCharts(document.querySelector("#netProfit"), {
                            chart: {
                                type: 'bar',
                                height: 350,
                            },
                            series: [{
                                name: 'Net Profit',
                                data: netProfitData,
                            }],
                            xaxis: {
                                type: 'category',
                            },
                        });

                        netProfitChart.render();
                    });
                </script>
            </div>
        </div>

    </div>

    </div>

    <script src="{{ $userbyGenderChart->cdn() }}"></script>


    {{ $userbyGenderChart->script() }}
@endsection
