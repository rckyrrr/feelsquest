@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="mb-3">
            <h1 class="fw-bold">Data Gaji</h1>
        </div>

        <div class="row gap-4">
            <div class="col shadow p-4 mb-5 bg-white rounded">
                <div class="col-md-11 mx-auto">
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
            </div>
        </div>

        <div class="row shadow p-4 mb-5 bg-white rounded">
            <table class="table table-hover" id="table-admin-gaji">
                <thead>
                    <tr>
                        <th>Nama Konselor</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($totalPendapatanCounselor as $dataGaji)
                        <tr>
                            <td>{{ $dataGaji->counselorname }}</td>
                            <td>{{ \Carbon\Carbon::parse($dataGaji->counselingmonth)->format('F Y') }}</td>
                            <td>@rupiah($dataGaji->total_pendapatan)</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-admin-gaji').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
