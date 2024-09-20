@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <div class="col-md-10 mx-auto text-center">
                <h2 class="fw-bold">Grafik Perkembangan {{ $testResult->test->name }}</h2>
                <div id="chart-perkembangan"></div>
            </div>
        </div>

        <form action="/tes-mental/konselor/perkembangan?testResult_id={{ $testResult->testResult_uuid }}" method="post">
            @csrf
            <label for="penjelasan" class="fw-bold mb-3">Penjelasan Singkat</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" id="penjelasan" name="penjelasan"
                    style="height: 200px"></textarea>
                <label for="penjelasan">Hasil Analisis</label>
            </div>

            <label for="solusi" class="fw-bold mb-3">Solusi Umum Terkait Masalahmu</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" id="solusi" name="solusi" style="height: 200px"></textarea>
                <label for="solusi">Hasil Analisis</label>
            </div>

            <div class="d-grid row">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var chart = new ApexCharts(document.querySelector("#chart-perkembangan"), {
            chart: {
                type: 'line', // Jenis grafik (misalnya line, bar, pie)
                height: 350, // Tinggi grafik dalam pixel
                // ... tambahkan opsi lain yang diperlukan
            },
            series: [{
                name: '{{ $testResult->test->name }}', // Nama seri data
                data: [
                    @foreach ($dataGrafik as $result)
                        @if ($result->test->id == $testResult->test->id)
                            {{ $result->score }},
                        @endif
                    @endforeach
                ] // Nilai-nilai seri data
            }],
            stroke: {
                curve: 'smooth' // Menggunakan kurva yang halus
            }
        });
        chart.render();
    </script>
@endsection
