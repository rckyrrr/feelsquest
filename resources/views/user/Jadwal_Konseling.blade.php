@extends('template.Dashboard_Template')

@section('konten')
    <div class="container">
        <div class="position-relative m-3">
            <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100" style="height: 2px;">
                <div class="progress-bar" style="width: 50%"></div>
            </div>
            <a href="/konseling/paket"
                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">1</a>
            <div class="position-absolute top-0 start-0 translate-middle mt-5">
                Pilih Paket
            </div>
            <a href="#" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">2</a>
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
                <h1 class="fw-bold">Pilih Tanggal</h1>
            </div>
            <form action="/konseling/jadwal">
                <input hidden type="text" name="packageID" class="form-control" id="tanggal"
                    placeholder="name@example.com" value="{{ $packageID }}">
                @if (isset($prakonseling))
                    <input hidden type="text" name="prakonseling" class="form-control" id="prakonseling"
                        value="{{ $prakonseling }}">
                @endif
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" name="tanggal" class="form-control" id="tanggal"
                                value="{{ request('tanggal') }}" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                            <label for="floatingInput">Pilih Tanggal</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <select name="jam" id="jam" class="form-select">
                                @for ($i = 7; $i < 21; $i++)
                                    <option hidden value="{{ request('jam') }}">{{ request('jam') }}
                                    </option>
                                    <option value="{{ $i . '.00' }} - {{ $i + 1 . '.00' }}">{{ $i . '.00' }} -
                                        {{ $i + 1 . '.00' }}
                                    </option>
                                    <option value="{{ $i . '.30' }} - {{ $i + 1 . '.30' }}">{{ $i . '.30' }} -
                                        {{ $i + 1 . '.30' }}
                                    </option>
                                @endfor
                            </select>
                            <label for="jam">Pilih Jam</label>
                        </div>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary block mt-3 mt-lg-0">Cek Jadwal</button>
                    </div>
                </div>
            </form>
        </div>
        @if (request('tanggal'))
            <div class="py-5 text-center">
                <div class="my-5">
                    <h1 class="fw-bold">Konselor Tersedia</h1>
                </div>


                <div class="row row-cols-1 row-cols-md-4 g-5 justify-content-center">
                    @foreach ($konselors as $data)
                        <div class="col">
                            <div class="card h-100 shadow bg-body rounded">
                                <div class="p-4">
                                    <img src="{{ asset('image_uploaded/image_user/' . $data->foto) }}" class="card-img-top"
                                        alt="..." height="275">
                                </div>
                                <div class="card-body">
                                    <h1 class="text-dark fw-bold mb-2">{{ $data->name }}</h1>
                                    <p class="card-text">{{ strtoupper($data->user_type) }}</p>
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-primary block mt-3 mt-lg-0"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data->id }}">Lihat
                                            Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $data->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ asset('image_uploaded/image_user/' . $data->foto) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div class="col px-4">
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Tahun Kelahiran</h6>
                                                    <p>{{ $currentYear - $data->umur }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Bahasa</h6>
                                                    <p>{{ $data->bahasa }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Keahlian Utama</h6>
                                                    <p>{{ $data->keahlian_utama }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col">
                                                <h6 class="fw-bold">Pendekatan</h6>
                                                @if ($data->pendekatan != null)
                                                    <p>{{ $data->pendekatan }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <h6 class="fw-bold">Keahlian Lainnya</h6>
                                                @if ($data->keahlian_lainnya != null)
                                                    <p>{{ $data->keahlian_lainnya }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div id="carouselExample" class="carousel slide" data-bs-interval="false">
                                                <div class="carousel-inner px-5">
                                                    @foreach ($konselors as $index => $item)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }} px-5">
                                                            <div class="row shadow p-3 my-2 bg-body-tertiary rounded">
                                                                <div class="col-md-2">
                                                                    <img src="{{ asset('src/assets/Homepage Konselor 1.png') }}"
                                                                        alt="" class="img-fluid">
                                                                </div>
                                                                <div class="col">
                                                                    <h6 class="fw-bold">{{ $item->name }}</h6>
                                                                    <p>{{ strtoupper($item->user_type) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExample" data-bs-slide="prev">
                                                    <i class="bi bi-chevron-left text-dark fs-3"></i>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExample" data-bs-slide="next">
                                                    <i class="bi bi-chevron-right text-dark fs-3"></i>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-grid">
                                            @if (isset($prakonseling))
                                                <a href="/konseling/pra-konseling?packageID={{ $packageID }}&tanggal={{ $tanggal }}&jam={{ $jam }}&counselorID={{ $data->uuid }}&prakonseling={{ $prakonseling }}"
                                                    class="btn btn-primary block mt-3 mt-lg-0">Pilih
                                                    Konselor</a>
                                            @else
                                                <a href="/konseling/pra-konseling?packageID={{ $packageID }}&tanggal={{ $tanggal }}&jam={{ $jam }}&counselorID={{ $data->uuid }}"
                                                    class="btn btn-primary block mt-3 mt-lg-0">Pilih
                                                    Konselor</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
