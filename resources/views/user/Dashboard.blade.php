@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>
        <p class="mb-3">Let's Track Your Feeling!</p>

        <div class="row shadow p-4 mb-4 bg-white rounded text-center">

            <h2 class="fw-bold">Quotes of the day</h2>
            <p>"{{ cache('qotd') }}"</p>

        </div>

        <div class="row gap-4">
            @foreach ($tests as $test)
                <div class="col shadow p-4 mb-4 bg-white rounded text-center">
                    <p class="fw-bold">{{ $test->name }}</p>
                    @php
                        $tesUser = null;
                        foreach ($test->result as $tes) {
                            if ($tes->klien_id == Auth::user()->id) {
                                $tesUser = $tes;
                            }
                        }
                    @endphp


                    @if ($tesUser)
                        @if ($tesUser->test_id == 1)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 7)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Kecemasan Minimal</p>
                            @elseif($tesUser->score >= 8 && $tesUser->score <= 15)
                                <p class="display-3"><i class="bi bi-emoji-laughing"></i></p>
                                <p class="fw-bold">Kecemasan Ringan</p>
                            @elseif($tesUser->score >= 16 && $tesUser->score <= 25)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i></p>
                                <p class="fw-bold">Kecemasan Moderat</p>
                            @elseif($tesUser->score >= 26 && $tesUser->score <= 63)
                                <p class="display-3"><i class="bi bi-emoji-smile-upside-down"></i></p>
                                <p class="fw-bold">Kecemasan Berat</p>
                            @endif
                        @elseif ($tesUser->test_id == 2)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 6)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Sehat</p>
                            @elseif($tesUser->score >= 7 && $tesUser->score <= 29)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i> </p>
                                <p class="fw-bold">Tidak Sehat</p>
                            @endif
                        @elseif ($tesUser->test_id == 3)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 10)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Pasang Surut ini dianggap Normal</p>
                            @elseif($tesUser->score >= 11 && $tesUser->score <= 16)
                                <p class="display-3"><i class="bi bi-emoji-laughing"></i></p>
                                <p class="fw-bold">Gangguan Mood Ringan</p>
                            @elseif($tesUser->score >= 17 && $tesUser->score <= 20)
                                <p class="display-3"><i class="bi bi-emoji-smile"></i></p>
                                <p class="fw-bold">Depresi Klinis di Ambang Batas</p>
                            @elseif($tesUser->score >= 21 && $tesUser->score <= 30)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i></p>
                                <p class="fw-bold">Depresi Sedang</p>
                            @elseif($tesUser->score >= 31 && $tesUser->score <= 40)
                                <p class="display-3"><i class="bi bi-emoji-expressionless"></i></p>
                                <p class="fw-bold">Depresi Berat</p>
                            @elseif($tesUser->score > 40)
                                <p class="display-3"><i class="bi bi-emoji-smile-upside-down"></i></p>
                                <p class="fw-bold">Depresi Ekstrim</p>
                            @endif
                        @endif
                        <p class="fw-bold">Total Skor Kamu : {{ $tesUser->score }} / @if ($tesUser->test_id == 1 || $tesUser->test_id == 3)
                                63
                            @elseif ($tesUser->test_id == 2)
                                29
                            @endif
                        </p>
                        <a href="/test?test_id={{ $test->test_uuid }}" class="btn btn-outline-primary w-100">Tes
                            Sekarang</a>
                    @else
                        <p class="display-3"><i class="bi bi-clipboard-data"></i></p>
                        <p class="fw-bold">Lakukan Tes Untuk Mendapatkan Skor</p>
                        <a href="/test?test_id={{ $test->test_uuid }}" class="btn btn-outline-primary w-100">Tes
                            Sekarang</a>
                    @endif

                </div>
            @endforeach
        </div>

        @if ($transaction)
            @if ($next_counseling)
                <div class="row gap-4">
                    <div class="col-md-3 shadow p-4 mb-4 bg-white rounded text-center">
                        <h3 class="fw-bold mb-3">Konseling Mendatang</h3>

                        <b>Nama Konselor</b>
                        <p>{{ $counselor->name }}</p>

                        <b>Tanggal</b>
                        <p>{{ date('d F Y', strtotime($next_counseling->counseling_date)) }}</p>

                        <b>Jam</b>
                        <p>{{ date('H:i', strtotime($next_counseling->counseling_start)) }}</p>

                        <div class="d-grid gap-3">
                            <a href="/createSession?counseling_id={{ $next_counseling->counselingUUID }}"
                                class="btn btn-primary w-100"><i class="bi bi-calendar-fill"></i> Tandai
                                Kalender</a>
                            <a href="#!" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#pre-konseling{{ $next_counseling->id }}"><i
                                    class="bi bi-clipboard-check"></i>
                                Cek
                                Pre
                                Konseling</a>
                        </div>

                    </div>
                    <div class="modal fade" id="pre-konseling{{ $next_counseling->id }}" tabindex="-1"
                        aria-labelledby="prekonselingLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Pra
                                        Konseling
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-bold">Detail Konselor</p>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <b>Nama</b>
                                            <p>{{ $next_counseling->counselor->name }}</p>
                                            <b>Pendekatan</b>
                                            <p>{{ $next_counseling->counselor->pendekatan }}</p>
                                        </div>
                                        <div class="col">
                                            <b>Keahlian Utama</b>
                                            <p>{{ $next_counseling->counselor->keahlian_utama }}</p>
                                            <b>Telah Melakukan Konseling Sejak</b>
                                            <p>{{ date('Y', strtotime($next_counseling->counselor->created_at)) }}
                                            </p>
                                        </div>
                                        <b>Detail Pra Konseling</b>
                                        <p>{{ $next_counseling->issues }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($old_counseling)
                        <div class="col shadow p-4 mb-4 bg-white rounded">
                            <b>Feedback Terbaru dari Konselor</b><br>
                            <b>Permasalahan</b>
                            <p>{{ $old_counseling->counselingResult->permasalahan }}</p>

                            <b>Catatan</b>
                            <p>{{ $old_counseling->counselingResult->catatan }}</p>

                            <b>Evaluasi Keadaan Psikis</b>
                            <p>{{ $old_counseling->counselingResult->evaluasi_psikis }}</p>

                            <b>Hal yang perlu diperhatikan</b>
                            <p>{{ $old_counseling->counselingResult->hal_diperhatikan }}</p>

                            <b>Saran</b>
                            <p>{{ $old_counseling->counselingResult->saran }}</p>
                        </div>
                    @else
                        <div class="col shadow p-4 mb-4 bg-white rounded">
                            <b>Feedback Terbaru dari Konselor</b><br>

                            <b>Permasalahan</b>
                            <p>-</p>

                            <b>Catatan</b>
                            <p>-</p>

                            <b>Evaluasi Keadaan Psikis</b>
                            <p>-</p>

                            <b>Hal yang perlu diperhatikan</b>
                            <p>-</p>

                            <b>Saran</b>
                            <p>-</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="row gap-4">
                    <div class="col-md-4 shadow p-5 mb-4 bg-white rounded text-center">
                        <h3 class="fw-bold">Konseling Privat dengan Psikolog</h3>
                        <a href="/konseling/user" class="btn btn-primary w-100"><i class="bi bi-calendar-fill"></i>
                            Jadwalkan
                            Konseling</a>
                    </div>
                    <div class="col shadow p-5 mb-4 bg-white rounded">

                        <form action="" method="get">
                            @csrf
                            <div class="mb-3">
                                <label for="prakonseling" class="form-label fw-bold">Yuk ceritain masalahmu! Tenang,
                                    ceritamu
                                    aman
                                    bersama Feelsbox</label>
                                <textarea name="prakonseling" id="prakonseling" class="form-control" rows="5"></textarea>
                            </div>


                            <button type="submit" class="btn btn-primary w-100">Selesai</button>
                        </form>
                    </div>
                </div>
            @endif
        @else
            <div class="row gap-4">
                <div class="col-md-4 shadow p-5 mb-4 bg-white rounded text-center">
                    <h3 class="fw-bold">Konseling Privat dengan Psikolog</h3>
                    <a href="/konseling/user" class="btn btn-primary w-100"><i class="bi bi-calendar-fill"></i> Jadwalkan
                        Konseling</a>
                </div>
                <div class="col shadow p-5 mb-4 bg-white rounded">
                    <form action="/konseling/paket" method="get">
                        @csrf
                        <div class="mb-3">
                            <label for="prakonseling" class="form-label fw-bold">Yuk ceritain masalahmu! Tenang, ceritamu
                                aman
                                bersama Feelsbox</label>
                            <textarea name="prakonseling" id="prakonseling" class="form-control" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Selesai</button>
                    </form>
                </div>
            </div>
        @endif

        {{-- <div class="row gap-4">
            <div class="col-md-4 shadow p-4 mb-4 bg-white rounded text-center">
                <h3 class="fw-bold mb-3">Konseling Mendatang</h3>

                <b>Nama Konselor</b>
                <p>Mbak Yeyen</p>

                <b>Tanggal</b>
                <p>23 Agustus 2023</p>

                <b>Jam</b>
                <p>09.30</p>

                <div class="d-grid gap-4">
                    <a href="#!" class="btn btn-primary w-100"><i class="bi bi-calendar-fill"></i> Tandai Kalender</a>
                    <a href="#!" class="btn btn-outline-primary w-100"><i class="bi bi-clipboard-check"></i> Cek Pre
                        Konseling</a>
                </div>
            </div>
            <div class="col shadow p-4 mb-4 bg-white rounded">
                <b>Permasalahan</b>
                <p>Depresi</p>

                <b>Feedback Terbaru dari Konselor</b>
                <p>Feedbacknya Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam illum sapiente perferendis
                    dicta pariatur consequatur modi voluptates sunt odit quibusdam, dolor at, dolore iure facilis officia
                    quo nihil alias necessitatibus facere et maiores asperiores aperiam vero aspernatur. Quam autem,
                    adipisci ipsa assumenda velit iusto veniam quasi eligendi ea animi voluptas pariatur fuga? Sapiente
                    error reiciendis ducimus, consequuntur non hic quas illum dignissimos nam perferendis iste saepe maiores
                    perspiciatis nulla animi est eos cumque voluptate ipsa! Harum laudantium laboriosam doloribus
                    consequatur temporibus illum tenetur? Expedita odit hic eaque aspernatur est dolores sit corporis
                    inventore deserunt porro. Ea dolorum praesentium saepe nam!</p>
            </div>
        </div> --}}
    </div>
@endsection
