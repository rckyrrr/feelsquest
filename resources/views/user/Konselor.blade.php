@extends('template.Home_Template')

@section('konten')
    <div class="container-fluid bg-primary py-5 mb-5 text-center text-white">
        <div class="py-5 container">
            <h1 class="fw-bold">Konselor Feelsbox</h1>
            <p>Feelsbox adalah startup yang menghadirkan layanan konsultasi psikologis. Memberi solusi terbaik untuk sobat
                yang sedang mengalami masalah mental. Dengan misi menjaga kesehatan mental masyarakat, kami akan memberikan
                yang terbaik untuk klien. </p>
        </div>
    </div>

    <div class="container mb-5 py-5">
        <div class="row row-cols-1 row-cols-md-4 g-5 justify-content-center">
            @foreach ($konselor as $k)
                <div class="col">
                    <div class="card h-100 shadow bg-body rounded">
                        <div class="p-4">
                            <img src="{{ asset('image_uploaded/image_user/' . $k->foto) }}" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h1 class="text-dark fw-bold mb-2">{{ $k->name }}</h1>
                            <p class="card-text">{{ $k->user_type }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
