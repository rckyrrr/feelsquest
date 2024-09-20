@extends('template.Home_Template')

@section('konten')
    <div class="container my-5">
        <div class="row gap-5">
            <div class="col">
                <div class="mb-5 pb-5">
                    <h1 class="fw-bold display-1">Bergabunglah</h1>
                    <h1 class="fw-bold display-1">Bersama</h1>
                    <h1 class="fw-bold display-1">Kami!</h1>
                </div>
                <div class="col shadow p-5 mb-5 bg-white rounded">
                    <a href="#!" class="row align-items-center text-decoration-none text-dark">
                        <div class="col-md-2">
                            <i class="text-primary bi bi-whatsapp display-1"></i>
                        </div>
                        <div class="col text-start">
                            <h2 class="fw-bold">Whatsapp</h2>
                            <p>08123456789012</p>
                        </div>
                    </a>
                </div>
                <div class="col shadow p-5 mb-5 bg-white rounded">
                    <a href="#!" class="row align-items-center text-decoration-none text-dark">
                        <div class="col-md-2">
                            <i class="text-primary bi bi-envelope display-1"></i>
                        </div>
                        <div class="col text-start">
                            <h2 class="fw-bold">Email</h2>
                            <p>helpdesk@feelsbox.id</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <img src="{{ asset('src/assets/Konselor Page Image.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
