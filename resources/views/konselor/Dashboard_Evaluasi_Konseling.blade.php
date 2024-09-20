@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="mb-3">
            <h1 class="fw-bold">Evaluasi Konseling</h1>
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

        <form
            action="/konseling/konselor/add-evaluasi-konseling?counselingResult_id={{ $detailCounseling->counselingResult->resultCounseling_uuid }}"
            method="post">
            @csrf

            <label for="psikis" class="fw-bold mb-3">Evaluasi Keadaan Psikis</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="evaluasi_psikis" id="psikis"
                    style="height: 200px"></textarea>
                <label for="psikis">Hasil Analisis</label>
            </div>

            <label for="hal" class="fw-bold mb-3">Hal yang perlu diperhatikan</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="hal" id="hal" style="height: 200px"></textarea>
                <label for="hal">Hasil Analisis</label>
            </div>

            <label for="saran" class="fw-bold mb-3">Saran</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="saran" id="saran" style="height: 200px"></textarea>
                <label for="saran">Hasil Analisis</label>
            </div>

            <div class="d-grid row">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
