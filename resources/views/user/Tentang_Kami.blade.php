@extends('template.Home_Template')

@section('konten')
    <div class="text-center container col-md-3 my-5">
        <img src="{{ asset('src/logo/Logo and Text/Logo and Text Default.png') }}" alt="" class="img-fluid">
    </div>
    <div class="container-fluid bg-primary py-5 mb-5 text-center text-white">
        <div class="py-5 container">
            <h1 class="fw-bold">Who Are We?</h1>
            <p>{{ $dataPerusahaan->deskripsi }} </p>
        </div>
    </div>

    <div class="text-center">
        <h1 class="fw-bold text-second">Our Team</h1>
    </div>
    <div class="container mb-5 py-5">
        <div class="row row-cols-1 row-cols-md-4 g-5 justify-content-center">
            @foreach ($dataTim as $tim)
                <div class="col">
                    <div class="card h-100 shadow bg-body rounded">
                        <div class="p-4">
                            <img src="{{ asset('image_uploaded/image_tim/' . $tim->foto) }}" class="card-img-top"
                                alt="...">
                        </div>
                        <div class="card-body">
                            <h1 class="text-dark fw-bold mb-2">{{ $tim->nama }}</h1>
                            <p class="card-text">{{ $tim->jabatan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
