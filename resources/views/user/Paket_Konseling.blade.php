@extends('template.Dashboard_Template')

@section('konten')
    <div class="container">
        <div class="position-relative m-3">
            <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100" style="height: 2px;">
                <div class="progress-bar"></div>
            </div>
            <button type="button"
                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">1</button>
            <div class="position-absolute top-0 start-0 translate-middle mt-5">
                Pilih Paket
            </div>
            <button type="button"
                class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-secondary rounded-pill"
                style="width: 2rem; height:2rem;">2</button>
            <div class="position-absolute top-0 start-50 translate-middle mt-5">
                Pilih Tanggal & Konselor
            </div>
            <button type="button"
                class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill"
                style="width: 2rem; height:2rem;">3</button>
            <div class="position-absolute top-0 start-100 translate-middle mt-5 text-center">
                Pra Konseling
            </div>
        </div>
        <div class="py-5 my-5 text-center">
            <div class="my-5">
                <h1 class="fw-bold">Pilih Paket</h1>
            </div>

            <div class="row row-cols-1 row-cols-md-3 justify-content-center g-5">

                @foreach ($package as $data)
                    <div class="col">
                        <div class="shadow p-5 bg-white rounded h-100">
                            <div class="mb-2">
                                <p class="lead fw-bold text-primary">{{ $data->name }}</p>
                            </div>
                            <div class="mb-2">
                                <p class="lead fw-bold">{{ $data->total_sessions }} Sesi</p>
                            </div>
                            <div class="mb-4">
                                <h2 class="fw-bold">@rupiah($data->price)</h2>
                            </div>
                            <div class="d-grid mb-4">
                                @if (isset($prakonseling))
                                    <a href="/konseling/jadwal?packageID={{ $data->packageUUID }}&prakonseling={{ $prakonseling }}"
                                        class="btn btn-primary" type="button">Pilih Paket</a>
                                @else
                                    <a href="/konseling/jadwal?packageID={{ $data->packageUUID }}" class="btn btn-primary"
                                        type="button">Pilih Paket</a>
                                @endif
                            </div>
                            <ul class="text-start">
                                @foreach ($data->features as $feature)
                                    <li>{{ $feature->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach

                <!-- Buat Featured Paket -->
                {{-- <div class="col">
                    <div class="shadow p-5 bg-primary text-white rounded h-100">
                        <div class="mb-2">
                            <p class="lead fw-bold">Featured Paket</p>
                        </div>
                        <div class="mb-2">
                            <p class="lead fw-bold">1 Sesi</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="fw-bold">Rp. 100.000</h2>
                        </div>
                        <div class="d-grid mb-4">
                            <a href="/konseling/jadwal" class="btn btn-light" type="button">Pilih Paket</a>
                        </div>
                        <ul class="text-start">
                            <li>Fitur</li>
                            <li>Fitur</li>
                            <li>Fitur</li>
                        </ul>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
@endsection
