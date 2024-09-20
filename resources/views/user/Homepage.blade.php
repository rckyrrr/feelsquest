@extends('template.Home_Template')

@section('konten')
<section id="Cover">
    <div class="container py-5">

        <div class="row align-items-center">
            <div class="col">
                <div>
                    <p class="text-uppercase display-4 text-center text-lg-start fw-cover mb-3">Jangan biarkan Keadaan psikismu mempengaruhi <b
                            class="text-primary">Kualitas hidupmu!</b></p>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <a href="/paket" class="btn btn-primary me-md-3">Konsultasikan Masalahmu</a>
                    <a href="/test-mental" class="btn btn-outline-primary">Cari Tau Kondisi Mentalmu</a>
                </div>
            </div>
            <div class="col text-center d-none d-lg-block">
                <img src="{{ asset('src/assets/Homepage Image 1.png') }}" alt="" class="img-fluid ">
            </div>
        </div>

    </div>
</section>

<section id="Fitur">
    <div class="container-fluid bg-tranparan my-5 py-5">
        <div class="row justify-content-center mx-3 mx-lg-0">
            <div class="col-lg-3 shadow p-3 bg-body rounded mx-4 mb-3 mb-lg-0 text-center">
                <a href="/test-mental" class="text-decoration-none text-dark">
                    <h1 class="display-1 text-primary"><i class="bi bi-book"></i></h1>
                    <h2 class="fs-2 fw-bold mb-3">Tes Mental</h2>
                    <p>Ayo pahami kondisi mental kamu dengan akurat! anti self-diagnose!</p>
                </a>
            </div>
            <div class="col-lg-3 shadow p-3 bg-body rounded mx-4 mb-3 mb-lg-0 text-center">
                <a href="/paket" class="text-decoration-none text-dark">
                    <h1 class="display-1 text-primary"><i class="bi bi-people-fill"></i></h1>
                    <h2 class="fs-2 fw-bold mb-3">Konseling</h2>
                    <p>Butuh solusi buat permasalahan kamu? Yuk ceritain aja!</p>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="Promosi">
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col text-center d-none d-lg-block">
                <img src="{{ asset('src/assets/Homepage Image 2.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col">
                <h1 class="display-4 fw-bold my-4">Feelsbox adalah wadah bagi ceritamu</h1>
                <p class="mb-5">Lebih baik menangis daripada marah, karena marah akan menyakiti orang lain, sementara
                    menangis
                    membuat kita mengeluarkan air mata yang mengalir melalui jiwa dan membersihkan hati.</p>
                <div class="text-end">
                    <h1 class="display-6 text-primary fw-bold mb-4">Mulai dari Rp 50.000</h1>
                    <a href="/paket" class="btn btn-primary">Yuk Ceritakan Masalahmu</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="Psikolog">
    <div class="container-fluid py-5 text-center bg-tranparan">
        <div class="container">
            <h1 class="display-6 fw-bold mb-5">Psikolog terbaik kami</h1>
            <div class="row row-cols-1 row-cols-md-4 g-5 justify-content-center">
                <div class="col">
                    <div class="card h-100 shadow bg-body rounded">
                        <div class="p-4">
                            <img src="{{ asset('src/assets/Homepage Konselor 1.png') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h1 class="text-dark fw-bold mb-2">Mbak Yeyen</h1>
                            <p class="card-text">Konselor</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow bg-body rounded">
                        <div class="p-4">
                            <img src="{{ asset('src/assets/Homepage Konselor 2.png') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h1 class="text-dark fw-bold mb-2">Mas Danang</h1>
                            <p class="card-text">Konselor Sebaya</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow bg-body rounded">
                        <div class="p-4">
                            <img src="{{ asset('src/assets/Homepage Konselor 3.png') }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h1 class="text-dark fw-bold mb-2">Budi Hartono</h1>
                            <p class="card-text">Konselor Sebaya</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
