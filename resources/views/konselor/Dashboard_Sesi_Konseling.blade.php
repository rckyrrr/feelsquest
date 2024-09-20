@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="mb-3">
            <h1 class="fw-bold">Sesi Konseling</h1>
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

        </div>

        <form action="/konseling/konselor/end-konseling?counseling_id={{ $detailCounseling->counselingUUID }}"
            method="post">
            @csrf
            <div class="row form-floating mb-4">
                <input type="text" class="form-control" id="permasalahan" name="permasalahan"
                    placeholder="name@example.com">
                <label for="permasalahan">Permasalahan</label>
            </div>


            <label for="catatan" class="fw-bold mb-3">Catatan</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" id="catatan" name="catatan" style="height: 200px"></textarea>
                <label for="catatan">Hasil Analisis</label>
            </div>

            <div class="d-grid row">
                <a href="#!" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AkhiriSesi">Simpan dan
                    Akhiri Sesi</a>
            </div>


            <!-- Modal Akhiri Sesi-->
            <div class="modal fade" id="AkhiriSesi" tabindex="-1" aria-labelledby="AkhiriSesiLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h1 class="display-1 text-danger"><i class="bi bi-question-circle"></i></h1>
                            <div class="my-3">
                                <b>Simpan dan Akhiri Sesi? ?</b>
                            </div>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Kembali</button>
                                {{-- <button type="submit" class="btn btn-danger">Hapus</button> --}}
                                <button type="submit" class="btn btn-danger">Akhiri</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Akhiri Sesi-->
        </form>
    </div>
@endsection
