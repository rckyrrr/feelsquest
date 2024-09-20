@extends('template.Home_Template')

@section('konten')
    <div class="container-fluid bg-primary py-5 mb-5 text-center text-white">
        <div class="py-5 container">
            <h1 class="fw-bold">Paket</h1>
            <p>Feelsbox adalah startup yang menghadirkan layanan konsultasi psikologis. Memberi solusi terbaik untuk sobat
                yang sedang mengalami masalah mental. Dengan misi menjaga kesehatan mental masyarakat, kami akan memberikan
                yang terbaik untuk klien. </p>
        </div>
    </div>

    <div class="container mb-5 py-5">
        <div class="row row-cols-1 row-cols-md-3 justify-content-center g-5">
            @foreach ($packages as $package)
                <div class="col text-center">
                    <div class="shadow p-5 bg-white rounded h-100">
                        <div class="mb-2">
                            <p class="lead fw-bold text-primary">{{ $package->name }}</p>
                        </div>
                        <div class="mb-2">
                            <p class="lead fw-bold">{{ $package->total_sessions }} Sesi</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="fw-bold">@rupiah($package->price)</h2>
                        </div>
                        <div class="d-grid mb-4">
                            <a href="/konseling/jadwal?packageID={{ $package->packageUUID }}" class="btn btn-primary">Pilih
                                Paket</a>
                        </div>
                        <ul class="text-start">
                            @foreach ($package->features as $feature)
                                <li>{{ $feature->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
