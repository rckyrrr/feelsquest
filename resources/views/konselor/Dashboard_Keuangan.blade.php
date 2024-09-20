@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">

        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Pendapatan</b>
                <h1 class="fw-bold">@rupiah($total)</h1>
                <div id="totalPendapatan"></div>
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    var totalPendapatan = new ApexCharts(document.querySelector("#totalPendapatan"), {
                        chart: {
                            type: 'bar', // Jenis grafik (misalnya line, bar, pie)
                            height: 350, // Tinggi grafik dalam pixel
                            // ... tambahkan opsi lain yang diperlukan
                        },
                        series: [{
                            name: 'Total Amount', // Nama seri data
                            data: [
                                @foreach ($allMonthsPendapatan as $month)
                                    {
                                        x: '{{ \Carbon\Carbon::parse($month)->format('F Y') }}', // Label bulan
                                        y: {{ $totalPendapatan->where('counselingmonth', $month)->first()->total_pendapatan ?? 0 }} // Nilai total_amount atau 0 jika tidak ada data
                                    },
                                @endforeach
                            ] // Nilai-nilai seri data
                        }],
                        xaxis: {
                            type: 'category' // Jenis axis x sebagai kategori
                        },
                        // ... tambahkan opsi grafik lainnya
                    });

                    totalPendapatan.render();
                </script>

            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <h3 class="fw-bold">Hasil Pendapatan</h3>
                <table class="table table-hover" id="table-admin-gaji">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allMonthsPendapatan as $month)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($month)->format('F Y') }}</td>
                                <td>@rupiah($totalPendapatan->where('counselingmonth', $month)->first()->total_pendapatan ?? 0)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
