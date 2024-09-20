@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Net Profit Margin</b>
                <h1 class="fw-bold">{{ $netProfitMargin }}%</h1>
            </div>

            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Sesi Selesai</b>
                <h1 class="fw-bold">{{ $totalCompleted }}</h1>
            </div>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Gross Profit</b>
                <div id="grossProfit"></div>
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    var grossProfit = new ApexCharts(document.getElementById("grossProfit"), {
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

            <div class="col shadow p-5 mb-4 bg-white rounded">
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

                        var netProfitChart = new ApexCharts(document.getElementById("netProfit"), {
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

        <div class="row gap-4 text-center">
            {{-- <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Pengeluaran Promo</b>
            </div> --}}

            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Menu</b>
                <div class="d-grid gap-2">
                    <a href="/data-keuangan/data-transaksi" class="btn btn-outline-primary">Data Transaksi</a>
                    <a href="/data-keuangan/data-gaji" class="btn btn-outline-primary">Data Gaji</a>
                </div>
            </div>
        </div>

    </div>
@endsection
