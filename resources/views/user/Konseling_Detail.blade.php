@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>
        <p class="mb-3">Let's Track Your Feeling!</p>

        <div class="row gap-4 text-center">
            <div class="col shadow p-4 mb-4 bg-white rounded">
                <b>Paket Koseling</b>
                <h2 class="fw-bold">{{ $detailCounseling->transaction->package->name }}</h2>
            </div>
            <div class="col shadow p-4 mb-4 bg-white rounded">
                <b>Tanggal</b>
                <h2 class="fw-bold">
                    {{ date('d F Y H:i', strtotime($detailCounseling->counseling_date . ' ' . $detailCounseling->counseling_start)) }}
                </h2>
            </div>
            <div class="col shadow p-4 mb-4 bg-white rounded">
                <b>Status</b>
                <h2 class="fw-bold">{{ ucfirst($detailCounseling->status_counseling) }}</h2>
            </div>
        </div>

        @if ($detailCounseling->counselingResult->feedback_user == null)
            <div class="row shadow p-4 mb-4 bg-white rounded">
                <div class="col">
                    <p>Bagaimana Pengalaman Konseling Terakhirmu ?</p>
                </div>
                <div class="col-md-2">
                    <a href="#!" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#FeedbackModal"><i
                            class="bi bi-star-fill"></i> Beri Feedback</a>
                </div>
            </div>
        @endif


        <!-- Modal -->
        <div class="modal fade" id="FeedbackModal" tabindex="-1" aria-labelledby="FeedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered rounded modal-lg text-start">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col">
                                <h1 class="modal-title fs-4 fw-bold" id="FeedbackModalLabel">
                                    Feedback Konseling</h1>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                        <form action="/konseling/add-feedback?counseling_id={{ $detailCounseling->counselingUUID }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="pengalaman" class="form-label fw-bold">Ceritakan pengalamanmu selama konseling
                                    !</label>
                                <textarea name="pengalaman" id="pengalaman" class="form-control" rows="5" placeholder="Tulis Disini ..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="masukan" class="form-label fw-bold">Beri masukan untuk konselormu !</label>
                                <textarea name="masukan" id="masukan" class="form-control" rows="5" placeholder="Tulis Disini ..."></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <h3 class="fw-bold mb-3">Evaluasi</h3>
            <div class="mb-3">
                <b>Permasalahan</b>
                <p>{{ $detailCounseling->counselingResult->permasalahan }}</p>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Catatan</p>
                <p>{{ $detailCounseling->counselingResult->catatan }}</p>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Evaluasi Keadaan Psikis</p>
                <p>{{ $detailCounseling->counselingResult->evaluasi_psikis }}</p>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Hal yang perlu diperhatikan</p>
                <p>{{ $detailCounseling->counselingResult->hal_diperhatikan }}</p>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Saran</p>
                <p>{{ $detailCounseling->counselingResult->saran }}</p>
            </div>
        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <div class="mb-3">
                <p class="fw-bold">Pra-Konseling</p>
                <p>{{ $detailCounseling->issues }}</p>
            </div>
        </div>

        <div class="row shadow p-5 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('src/assets/Homepage Konselor 1.png') }}" alt="" class="img-fluid">
                </div>

                <div class="col px-4">
                    <h2 class="fw-bold">{{ $detailCounseling->counselor->name }}</h2>
                    <div class="mb-3">
                        <h6 class="fw-bold">Tahun Kelahiran</h6>
                        <p>{{ date('Y') - $detailCounseling->counselor->umur }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">Bahasa</h6>
                        <p>{{ $detailCounseling->counselor->bahasa }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">Keahlian Utama</h6>
                        <p>{{ $detailCounseling->counselor->keahlian_utama }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">Pendekatan</h6>
                        <p>{{ $detailCounseling->counselor->pendekatan }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-bold">Keahlian Lainnya</h6>
                        <p>{{ $detailCounseling->counselor->keahlian_lainnya }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
