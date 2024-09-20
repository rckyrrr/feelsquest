@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>
        <p class="mb-3">Let's Track Your Feeling!</p>


        <!-- ini kalau ga ada paket konseling isinya paket tidak ada -->
        <div class="row gap-4">
            @if ($transaction)
                <div class="col-md-3 shadow p-4 mb-4 bg-white rounded text-center d-flex justify-content-center flex-column">
                    <div class="mb-2">
                        <b>Paket saat ini</b>
                    </div>
                    <h1 class="fw-bold mb-3">{{ $transaction->package->name }}</h1>
                    <p>Anda memiliki <b>{{ $transaction->session_remaining }}</b> sesi tersedia</p>
                    @if ($transaction->session_remaining == 0)
                        <button type="button" class="btn btn-outline-primary mt-auto mt-auto w-100" disabled>Jadwalkan
                            Konseling</button>
                    @else
                        <a href="/konseling/jadwal?packageID={{ $transaction->package->packageUUID }}"
                            class="btn btn-outline-primary mt-auto mt-auto w-100">Jadwalkan
                            Konseling</a>
                    @endif
                </div>
            @else
                <div class="col-md-3 shadow p-4 mb-4 bg-white rounded text-center">
                    <div class="mb-2">
                        <b>Paket saat ini</b>
                    </div>
                    <h1 class="fw-bold mb-3">Tidak ada</h1>
                    <p>Anda tidak memiliki sesi tersedia</p>
                    <a href="/konseling/paket" class="btn btn-outline-primary w-100">Daftarkan Konseling</a>
                </div>
            @endif
            @if ($transaction)
                @if ($next_counseling != null)
                    <div class="col shadow p-4 mb-4 bg-white rounded">
                        <p class="fw-bold">Detail Konselor</p>
                        <div class="row mb-3">
                            <div class="col">
                                <b>Nama</b>
                                <p>{{ $counselor->name }}</p>
                                <b>Pendekatan</b>
                                <p>{{ $counselor->pendekatan }}</p>
                            </div>
                            <div class="col">
                                <b>Keahlian Utama</b>
                                <p>{{ $counselor->keahlian_utama }}</p>
                                <b>Telah Melakukan Konseling Sejak</b>
                                <p>{{ date('Y', strtotime($counselor->created_at)) }}</p>
                            </div>
                        </div>
                        <a href="#!" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#detailCounselorNew">Cek Profil Konselor</a>
                        <div class="modal fade" id="detailCounselorNew" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $counselor->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ asset('image_uploaded/image_user/' . $counselor->foto) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div class="col px-4">
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Tahun Kelahiran</h6>
                                                    <p>{{ date('Y') - $counselor->umur }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Bahasa</h6>
                                                    <p>{{ $counselor->bahasa }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Keahlian Utama</h6>
                                                    <p>{{ $counselor->keahlian_utama }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col">
                                                <h6 class="fw-bold">Pendekatan</h6>
                                                @if ($counselor->pendekatan != null)
                                                    <p>{{ $counselor->pendekatan }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <h6 class="fw-bold">Keahlian Lainnya</h6>
                                                @if ($counselor->keahlian_lainnya != null)
                                                    <p>{{ $counselor->keahlian_lainnya }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col shadow p-4 mb-4 bg-white rounded">
                        <p class="fw-bold">Detail Konselor</p>
                        <div class="row mb-3">
                            <div class="col">
                                <b>Nama</b>
                                <p>{{ $old_counseling->counselor->name }}</p>
                                <b>Pendekatan</b>
                                <p>{{ $old_counseling->counselor->pendekatan }}</p>
                            </div>
                            <div class="col">
                                <b>Keahlian Utama</b>
                                <p>{{ $old_counseling->counselor->keahlian_utama }}</p>
                                <b>Telah Melakukan Konseling Sejak</b>
                                <p>{{ date('Y', strtotime($old_counseling->counselor->created_at)) }}</p>
                            </div>
                        </div>
                        <a href="#!" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#detailCounselorOld">Cek Profil Konselor</a>
                        <div class="modal fade" id="detailCounselorOld" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-fullscreen-lg-down">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            {{ $old_counseling->counselor->name }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ asset('image_uploaded/image_user/' . $old_counseling->counselor->foto) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div class="col px-4">
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Tahun Kelahiran</h6>
                                                    <p>{{ date('Y') - $old_counseling->counselor->umur }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Bahasa</h6>
                                                    <p>{{ $old_counseling->counselor->bahasa }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-bold">Keahlian Utama</h6>
                                                    <p>{{ $old_counseling->counselor->keahlian_utama }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col">
                                                <h6 class="fw-bold">Pendekatan</h6>
                                                @if ($old_counseling->counselor->pendekatan != null)
                                                    <p>{{ $old_counseling->counselor->pendekatan }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <h6 class="fw-bold">Keahlian Lainnya</h6>
                                                @if ($old_counseling->counselor->keahlian_lainnya != null)
                                                    <p>{{ $old_counseling->counselor->keahlian_lainnya }}</p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="col shadow p-4 mb-4 bg-white rounded">
                    <p class="fw-bold">Detail Konselor</p>
                    <div class="row mb-3">
                        <div class="col">
                            <b>Nama</b>
                            <p>-</p>
                            <b>Pendekatan</b>
                            <p>-</p>
                        </div>
                        <div class="col">
                            <b>Keahlian Utama</b>
                            <p>-</p>
                            <b>Telah Melakukan Konseling Sejak</b>
                            <p>-</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <!-- Kalau Ga Ada Konseling mendatang atau ga ada paket konseling ini hilang -->
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
                                data-bs-target="#pra-konseling{{ $next_counseling->id }}"><i
                                    class="bi bi-clipboard-check"></i>
                                Cek
                                Pre
                                Konseling</a>
                        </div>
                    </div>
                    <div class="modal fade" id="pra-konseling{{ $next_counseling->id }}" tabindex="-1"
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
            @endif
        @endif

        <div class="row gap-4">
            <div class="shadow p-4 mb-5 bg-white rounded">
                <h3 class="fw-bold mb-4">Riwayat Konseling</h3>
                <div class="d-flex mb-3" id="pills-tab" role="tablist">
                    <div class="col me-3">
                        <button class="btn btn-outline-primary w-100 active" id="pills-berlangsung-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-berlangsung" type="button" role="tab"
                            aria-controls="pills-berlangsung" aria-selected="true">Berlangsung</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-primary w-100" id="pills-selesai-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-selesai" type="button" role="tab" aria-controls="pills-selesai"
                            aria-selected="false">Selesai</button>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-berlangsung" role="tabpanel"
                        aria-labelledby="pills-berlangsung-tab" tabindex="0">
                        <table class="table table-hover" id="table-konseling-ongoing">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Konselor</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historyCounseling as $history)
                                    @if ($history->status_counseling == 'ongoing')
                                        <tr>
                                            <td>{{ $history->counselor->name }}</td>
                                            <td>{{ date('d F Y', strtotime($history->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($history->counseling_start)) }} -
                                                {{ date('H:i', strtotime($history->counseling_end)) }}</td>
                                            <td>
                                                <p class="btn btn-warning" style="color:white;">
                                                    {{ strtoupper($history->status_counseling) }}</p>
                                            </td>
                                            <td class="text-center">
                                                <!-- Kalau Berlangsung -->
                                                <a href="{{ $history->link_meet }}" target="_blank"
                                                    class="text-decoration-none">Join Room</a>
                                                <a href="#!" data-bs-toggle="modal"
                                                    data-bs-target="#pre-konseling{{ $history->id }}"
                                                    class="text-decoration-none ms-3">Pre-Konseling</a>
                                            </td>
                                        </tr>
                                    @elseif ($history->status_counseling == 'scheduled')
                                        <tr>
                                            <td>{{ $history->counselor->name }}</td>
                                            <td>{{ date('d F Y', strtotime($history->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($history->counseling_start)) }} -
                                                {{ date('H:i', strtotime($history->counseling_end)) }}</td>

                                            <!-- Kalau Berlangsung -->
                                            @if ($history->status_counseling == 'scheduled')
                                                <td>
                                                    <p class="btn btn-primary">
                                                        {{ strtoupper($history->status_counseling) }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#pre-konseling{{ $history->id }}"
                                                        class="text-decoration-none ms-3">Pre-Konseling</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                    <div class="modal fade" id="pre-konseling{{ $history->id }}" tabindex="-1"
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
                                                            <p>{{ $history->counselor->name }}</p>
                                                            <b>Pendekatan</b>
                                                            <p>{{ $history->counselor->pendekatan }}</p>
                                                        </div>
                                                        <div class="col">
                                                            <b>Keahlian Utama</b>
                                                            <p>{{ $history->counselor->keahlian_utama }}</p>
                                                            <b>Telah Melakukan Konseling Sejak</b>
                                                            <p>{{ date('Y', strtotime($history->counselor->created_at)) }}
                                                            </p>
                                                        </div>
                                                        <b>Detail Pra Konseling</b>
                                                        <p>{{ $history->issues }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="pills-selesai" role="tabpanel"
                        aria-labelledby="pills-selesai-tab" tabindex="0">
                        <table class="table table-hover" id="table-konseling-completed">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Konselor</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historyCounseling as $history)
                                    @if ($history->status_counseling == 'completed')
                                        <tr>
                                            <td>{{ $history->counselor->name }}</td>
                                            <td>{{ date('d F Y', strtotime($history->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($history->counseling_start)) }} -
                                                {{ date('H:i', strtotime($history->counseling_end)) }}</td>


                                            <td>
                                                <p class="btn btn-success">
                                                    {{ strtoupper($history->status_counseling) }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a href="/konseling/user/detail?counseling_id={{ $history->counselingUUID }}"
                                                    class="text-decoration-none">Lihat Detail</a>
                                                @if ($history->counselingResult->feedback_user == null)
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#FeedbackModal{{ $history->id }}"
                                                        class="text-decoration-none ms-3">Feedback</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="FeedbackModal{{ $history->id }}" tabindex="-1"
                                            aria-labelledby="FeedbackModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered rounded modal-lg text-start">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <h1 class="modal-title fs-4 fw-bold"
                                                                    id="FeedbackModalLabel">
                                                                    Feedback Konseling</h1>
                                                            </div>
                                                            <div class="col text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                        <form
                                                            action="/konseling/add-feedback?counseling_id={{ $history->counselingUUID }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="pengalaman"
                                                                    class="form-label fw-bold">Ceritakan pengalamanmu
                                                                    selama konseling
                                                                    !</label>
                                                                <textarea name="pengalaman" id="pengalaman" class="form-control" rows="5" placeholder="Tulis Disini ..."></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="masukan" class="form-label fw-bold">Beri
                                                                    masukan untuk konselormu !</label>
                                                                <textarea name="masukan" id="masukan" class="form-control" rows="5" placeholder="Tulis Disini ..."></textarea>
                                                            </div>
                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="modal fade" id="pre-konseling{{ $history->id }}" tabindex="-1"
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
                                                            <p>{{ $history->counselor->name }}</p>
                                                            <b>Pendekatan</b>
                                                            <p>{{ $history->counselor->pendekatan }}</p>
                                                        </div>
                                                        <div class="col">
                                                            <b>Keahlian Utama</b>
                                                            <p>{{ $history->counselor->keahlian_utama }}</p>
                                                            <b>Telah Melakukan Konseling Sejak</b>
                                                            <p>{{ date('Y', strtotime($history->counselor->created_at)) }}
                                                            </p>
                                                        </div>
                                                        <b>Detail Pra Konseling</b>
                                                        <p>{{ $history->issues }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
