@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Detail Konseling</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>ID Konseling</b>
                <h1 class="fw-bold">{{ $detailCounseling->counselingUUID }}</h1>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Tanggal</b>
                <h1 class="fw-bold">
                    {{ date('d F Y H:i', strtotime($detailCounseling->counseling_date . ' ' . $detailCounseling->counseling_start)) }}
                </h1>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Status</b>
                <h1 class="fw-bold">{{ ucfirst($detailCounseling->status_counseling) }}</h1>
            </div>
        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <p class="fw-bold">Detail Klien</p>

            <div class="row mb-3">
                <div class="col">
                    <b>Nama</b>
                    <p>{{ $detailCounseling->klien->name }}</p>
                </div>
                <div class="col">
                    <b>Umur</b>
                    <p>{{ $detailCounseling->klien->umur }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <b>Gender</b>
                    <p>{{ $detailCounseling->klien->gender }}</p>
                </div>
                <div class="col">
                    <b>Pekerjaan</b>
                    <p>{{ $detailCounseling->klien->pekerjaan }}</p>
                </div>
            </div>

            <div class="mb-3">
                <p class="fw-bold">Pra Konseling</p>

                <p>{{ $detailCounseling->issues }}</p>

            </div>

            @if ($detailCounseling->status_counseling == 'scheduled')
                <div class="d-grid">
                    <button class="btn btn-primary"><i class="bi bi-calendar-fill"></i> Tandai Calendar</button>
                </div>
            @endif
        </div>

        @if ($detailCounseling->status_counseling == 'completed')
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#HasilKonseling">Hasil
                        Konseling</button>
                </div>
                <div class="col">
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#EvaluasiKonseling">Feedback Konseling</button>
                </div>
            </div>

            <!-- Modal Hasil Konseling -->
            <div class="modal fade" id="HasilKonseling" tabindex="-1" aria-labelledby="HasilKonselingLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="row mb-3">
                                <div class="col">
                                    <h3 class="fw-bold" id="DataGajiLabel">Hasil Konseling</h3>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="d-flex mb-3" id="pills-tab" role="tablist">
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100 active" id="pills-psikis-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-psikis" type="button" role="tab"
                                        aria-controls="pills-psikis" aria-selected="true">Evaluasi Keadaan Psikis</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100" id="pills-hal-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-hal" type="button" role="tab" aria-controls="pills-hal"
                                        aria-selected="false">Hal Yang Perlu Diperhatikan</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100" id="pills-saran-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-saran" type="button" role="tab"
                                        aria-controls="pills-saran" aria-selected="false">Saran</button>
                                </div>

                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-psikis" role="tabpanel"
                                    aria-labelledby="pills-psikis-tab" tabindex="0">
                                    <p class="fw-bold">Evaluasi Keadaan Psikis</p>

                                    <p>{{ $detailCounseling->counselingResult->evaluasi_psikis }}</p>

                                </div>
                                <div class="tab-pane fade" id="pills-hal" role="tabpanel" aria-labelledby="pills-hal-tab"
                                    tabindex="0">
                                    <p class="fw-bold">Hal Yang Perlu Diperhatikan</p>

                                    <p>{{ $detailCounseling->counselingResult->hal_diperhatikan }}</p>
                                </div>
                                <div class="tab-pane fade" id="pills-saran" role="tabpanel"
                                    aria-labelledby="pills-saran-tab" tabindex="0">

                                    <p class="fw-bold">Saran</p>

                                    <p>{{ $detailCounseling->counselingResult->saran }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Hasil Konseling -->

            <!-- Modal Evaluasi Konseling -->
            <div class="modal fade" id="EvaluasiKonseling" tabindex="-1" aria-labelledby="EvaluasiKonselingLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="row mb-3">
                                <div class="col">
                                    <h3 class="fw-bold" id="DataGajiLabel">Evaluasi Konseling</h3>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                            </div>

                            <div class="d-flex mb-3" id="pills-tab" role="tablist">
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100 active" id="pills-pengalaman-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-pengalaman" type="button"
                                        role="tab" aria-controls="pills-pengalaman" aria-selected="true">Pengalaman
                                        Konseling</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100" id="pills-masukan-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-masukan" type="button"
                                        role="tab" aria-controls="pills-masukan"
                                        aria-selected="false">Masukan</button>
                                </div>

                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-pengalaman" role="tabpanel"
                                    aria-labelledby="pills-pengalaman-tab" tabindex="0">
                                    <p class="fw-bold">Pengalaman Konseling</p>

                                    <p>{{ $detailCounseling->counselingResult->feedback_user }}</p>

                                </div>
                                <div class="tab-pane fade" id="pills-masukan" role="tabpanel"
                                    aria-labelledby="pills-masukan-tab" tabindex="0">
                                    <p class="fw-bold">Masukan</p>

                                    <p>{{ $detailCounseling->counselingResult->masukan_user }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Akhir Modal Evaluasi Konseling -->

    </div>
@endsection
