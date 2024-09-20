@extends('template.Home_Template')

@section('konten')
    <div class="container-fluid bg-primary py-5 mb-5 text-center text-white">
        <div class="py-5">
            <p class="fw-bold mb-3">Kesehatan adalah kunci hidup</p>
            <h1 class="fw-cover text-uppercase">test kesehatan mental</h1>
            <p>Temukan hasil kesehatan mu disini, Tes ini menggunakan standar pengujian kesehatan mental yang valid</p>
        </div>
    </div>

    <div class="container mb-5 py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary mb-3">Jenis Tes</h1>
            <h4>pilih tes yang cocok untukmu</h4>
        </div>

        <div class="row justify-content-center">
            @foreach ($tests as $test)
                <div class="col-md-3 shadow px-3 py-5 bg-white rounded mx-4 text-center">
                    <a href="/test?test_id={{ $test->test_uuid }}" class="text-decoration-none  text-dark">
                        <img src="{{ asset('image_uploaded/image_test/' . $test->icon) }}" alt="" class="my-3"
                            height="100">
                        <h2 class="fs-2 fw-bold">{{ $test->name }}</h2>
                        <p>{{ $test->description }}</p>
                    </a>
                </div>
            @endforeach
            {{-- <div class="col-md-3 shadow px-3 py-5 bg-white rounded mx-4 text-center">
                <a href="/test-bai" class="text-decoration-none text-dark">
                    <img src="{{ asset('src/assets/Tes BAI.png') }}" alt="" class="my-3" height="100">
                    <h2 class="fs-2 fw-bold">Tes Kecemasan</h2>
                    <p>Back Anxiety Inventory</p>
                </a>
            </div>
            <div class="col-md-3 shadow px-3 py-5 bg-white rounded mx-4 text-center">
                <a href="#" class="text-decoration-none text-dark">
                    <img src="{{ asset('src/assets/Tes SRQ.png') }}" alt="" class="my-3" height="100">
                    <h2 class="fs-2 fw-bold">Tes Tingkat Kesehatan Mental</h2>
                    <p>Self-Repoerting Qutioner</p>
                </a>
            </div> --}}
        </div>
    </div>
@endsection
