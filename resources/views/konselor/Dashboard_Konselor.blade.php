@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>
        <div class="row">
            <div class="col shadow p-3 mb-3 me-3 bg-white">
                <h5 class="text-center fw-bold">Total Konsultasi</h5>
                <h2 class="text-center fw-bold">{{ $monthlyData->count() }}</h2>
                <div class="col-md-12">
                    {!! $totalCounseling->container() !!}
                    <script src="{{ $totalCounseling->cdn() }}"></script>
                    {{ $totalCounseling->script() }}
                </div>
            </div>
            <div class="col shadow p-3 mb-3 bg-white">
                <h5 class="text-center fw-bold">Total Konsultasi</h5>
                <h2 class="text-center fw-bold">{{ $monthlyData->count() }}</h2>

                <div class="col-md-6">
                    {!! $totalPemasukan->container() !!}

                    <script src="{{ $totalPemasukan->cdn() }}"></script>

                    {{ $totalPemasukan->script() }}
                </div>



            </div>
        </div>
        {{-- <div class="row row-cols-3">
            <div class="col shadow p-3 mb-3 mx-3 bg-white rounded">
                <h5 class="text-center fw-bold">Total Konsultasi</h5>
                <h2 class="text-center fw-bold">{{ $monthlyData->count() }}</h2>
                {!! $totalCounseling->container() !!}

                <script src="{{ $totalCounseling->cdn() }}"></script>

                {{ $totalCounseling->script() }}
            </div>
            <div class="col shadow p-3 mb-3 bg-white rounded">
                <h5 class="text-center fw-bold">Total Pemasukan</h5>
                <h2 class="text-center fw-bold">@rupiah($monthlyData->count() * 125000)</h2>
                {!! $totalPemasukan->container() !!}

                <script src="{{ $totalPemasukan->cdn() }}"></script>

                {{ $totalPemasukan->script() }}
            </div>
            <div class="col shadow p-3 mb-3 bg-white rounded">
                <h5 class="text-center fw-bold">Total Analisis Tes Mental</h5>
                <h2 class="text-center fw-bold">{{ $totalAnalisisAll->count() }}</h2>
                {!! $totalAnalisis->container() !!}

                <script src="{{ $totalAnalisis->cdn() }}"></script>

                {{ $totalAnalisis->script() }}
            </div>
            <div class="col shadow p-3 mb-3 bg-white rounded">
                <div class="text-center">
                    <b>Menu</b>
                    <div class="d-grid gap-2">
                        <a href="/konseling/konselor" class="btn btn-outline-primary">Cek Detail Konseling</a>
                        <a href="/tes-mental/konselor" class="btn btn-outline-primary">Analisis Tes Mental</a>
                    </div>
                </div>
            </div> --}}
    </div>

    <div class="row gap-5">

    </div>
    @if ($next_counseling != null)
        <div class="row gap-4">
            <div class="col-lg-3 shadow p-4 py-5 mb-4 bg-white rounded text-center">
                <h3 class="fw-bold mb-3">Konseling Mendatang</h3>
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col">
                        <b>Nama Klien</b>
                        <p>{{ $next_counseling->klien->name }}</p>
                    </div>
                    <div class="col">
                        <b>Tanggal</b>
                        <p>{{ date('d F Y', strtotime($next_counseling->counseling_date)) }}</p>
                    </div>
                    <div class="col">
                        <b>Jam</b>
                        <p>{{ date('H:i', strtotime($next_counseling->counseling_start)) }}</p>
                    </div>
                </div>
                <div class="d-grid gap-3">
                    <a href="/createSession?counseling_id={{ $next_counseling->counselingUUID }}&btn_id=1"
                        class="btn btn-primary w-100"><i class="bi bi-calendar-fill"></i> Tandai
                        Kalender</a>
                </div>
            </div>
            <div class="col shadow p-4 mb-4 bg-white rounded">
                <b class="mb-3">Detail Klien</b>

                <div class="row">
                    <div class="col">
                        <b>Nama</b>
                        <p>{{ $next_counseling->klien->name }}</p>

                        <b>Gender</b>
                        <p>{{ $next_counseling->klien->gender }}</p>

                    </div>
                    <div class="col">
                        <b>Usia</b>
                        <p>{{ $next_counseling->klien->umur }}</p>

                        <b>Pekerjaan</b>
                        <p>{{ $next_counseling->klien->pekerjaan }}</p>

                    </div>
                </div>

                <b>Pra Konseling</b>
                <p>{{ $next_counseling->issues }}</p>
            </div>
        </div>
    @endif

    {{-- <div class="mb-4">
            <h1 class="fw-bold">Testimoni Terbaru</h1>
        </div>
        <div class="row gap-4">
            @for ($i = 1; $i < 4; $i++)
                <div class="col shadow p-4 mb-4 bg-white rounded">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{ asset('src/assets/Homepage Konselor 1.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col">
                            <h6 class="fw-bold">Nama Tester</h6>
                            <p>Isi nya</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div> --}}
    </div>
@endsection
