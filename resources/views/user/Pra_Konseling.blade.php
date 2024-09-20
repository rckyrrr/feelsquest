@extends('template.Dashboard_Template')

@section('konten')
    <div class="container">
        <div class="position-relative m-3">
            <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100" style="height: 2px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
            <a href="/konseling/paket"
                class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">1</a>
            <div class="position-absolute top-0 start-0 translate-middle mt-5">
                Pilih Paket
            </div>
            <a href="/konseling/jadwal?packageID={{ $packageID }}"
                class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">2</a>
            <div class="position-absolute top-0 start-50 translate-middle mt-5">
                Pilih Tanggal & Konselor
            </div>
            <a href="#" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill"
                style="width: 2rem; height:2rem;">3</a>
            <div class="position-absolute top-0 start-100 translate-middle mt-5 text-center">
                Pra Konseling
            </div>
        </div>

        <div class="py-5 my-5">
            <div class="my-5 text-center">
                <h1 class="fw-bold">Pra Konseling</h1>
            </div>
            @if ($transaction)
                <form
                    action="/konseling/add-konseling?counselorID={{ $counselorID }}&jam={{ $jam }}&tanggal={{ $tanggal }}"
                    method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="prakonseling" class="form-label fw-bold">Jelaskan secara singkat permasalahanmu</label>
                        <textarea name="issues" id="prakonseling" class="form-control" rows="5"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            @else
                <form
                    action="/transaksi/createInvoice?packageID={{ $packageID }}&jam={{ $jam }}&tanggal={{ $tanggal }}&counselorID={{ $counselorID }}"
                    method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="prakonseling" class="form-label fw-bold">Jelaskan secara singkat permasalahanmu</label>
                        <textarea name="issues" id="prakonseling" class="form-control" rows="5">
@if (isset($prakonseling))
{{ $prakonseling }}
@endif
</textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            @endif
        </div>
    </div>
@endsection
