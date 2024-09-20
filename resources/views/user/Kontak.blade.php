@extends('template.Home_Template')

@section('konten')
    <div class="text-center container col-md-3 my-5">
        <img src="{{ asset('src/logo/Logo and Text/Logo and Text Default.png') }}" alt="" class="img-fluid">
    </div>

    <div class="container my-5">
        <div class="text-center">
            <h1 class="fw-bold my-5 ">Punya Pertanyaan Seputar Layanan Kami?</h1>

            <div class="row gap-5">
                <div class="col shadow p-4 mb-5 bg-white rounded">
                    <a href="#!" class="row align-items-center text-decoration-none text-dark">
                        <div class="col">
                            <i class="text-primary bi bi-whatsapp display-1"></i>
                        </div>
                        <div class="col text-start">
                            <h2 class="fw-bold">Whatsapp</h2>
                            <p>08123456789012</p>
                        </div>
                    </a>
                </div>
                <div class="col shadow p-4 mb-5 bg-white rounded">
                    <a href="#!" class="row align-items-center text-decoration-none text-dark">
                        <div class="col">
                            <i class="text-primary bi bi-envelope display-1"></i>
                        </div>
                        <div class="col text-start">
                            <h2 class="fw-bold">Email</h2>
                            <p>helpdesk@feelsbox.id</p>
                        </div>
                    </a>
                </div>
                <div class="col shadow p-4 mb-5 bg-white rounded">
                    <a href="#!" class="row align-items-center text-decoration-none text-dark">
                        <div class="col">
                            <i class="text-primary bi bi-pin-map-fill display-1"></i>
                        </div>
                        <div class="col text-start">
                            <h2 class="fw-bold">Alamat</h2>
                            <p>BTP</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-danger text-white text-center p-5 my-5">
        <p class="fw-bold">Jika Anda sedang mengalami krisis psikologis yang mengancam hidup Anda</p>
        <p class="fw-bold"> Segera Hubungi 119 untuk mendapat layanan cepat tanggap</p>
    </div>
@endsection
