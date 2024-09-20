@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <h1 class="fw-bold mb-3">Analisis {{ $testResult->test->name }}</h1>
        <div class="row gap-4 mb-4">
            <div class="col-md-7 shadow p-4 mb-3 bg-white rounded">
                <div id="myCarousel" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner mb-5" data-interval="false">
                        @foreach ($testQuestion as $indexSoal => $item)
                            <div class="carousel-item {{ $indexSoal == 0 ? 'active' : '' }}">
                                <h5 class="fw-bold">Pertanyaan {{ $indexSoal + 1 }} /
                                    {{ $testQuestion->count() }}</h5>
                                <b>{{ $item->question }}</b>
                                <div class="my-3">
                                    @foreach (json_decode($item->answer) as $indexJawaban => $answer)
                                        @php
                                            $userAnswers = json_decode($testResult->answer);
                                            $userAnswerIndex = $indexSoal; // Indeks jawaban user sesuai dengan urutan soal
                                            $isChecked = isset($userAnswers[$userAnswerIndex]) && $userAnswers[$userAnswerIndex] == $answer->value;
                                        @endphp

                                        <div class="form-check">
                                            <input disabled class="form-check-input" type="radio"
                                                name="answer[{{ $indexSoal }}]" id="answer{{ $indexJawaban }}"
                                                value="{{ $answer->value }}" {{ $isChecked ? 'checked' : '' }}>
                                            <label class="form-check-label" for="answer{{ $indexJawaban }}">
                                                {{ $answer->label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row mb-3">
                                    @if ($indexSoal != 0)
                                        <div class="col">
                                            <button class="btn btn-primary" data-bs-target="#myCarousel"
                                                data-bs-slide="prev"><i class="bi bi-chevron-left"></i></button>
                                        </div>
                                    @endif
                                    @if ($indexSoal != $testQuestion->count() - 1)
                                        <div class="col text-end">
                                            <button class="btn btn-primary" data-bs-target="#myCarousel"
                                                data-bs-slide="next"><i class="bi bi-chevron-right"></i></button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="col">
                <div class="row shadow p-4 mb-3 bg-white rounded">
                    <div class="col-md-4">
                        <h1 class="display-1 text-primary"><i class="bi bi-person-circle"></i></h1>
                    </div>
                    <div class="col">
                        <h3 class="fw-bold">{{ $testResult->klien->name }}</h3>
                        <p>{{ $testResult->klien->umur }}</p>
                        <p>{{ $testResult->klien->pekerjaan }}</p>
                    </div>
                </div>
                <div class="row shadow p-4 mb-3 bg-white rounded align-items-center">
                    <p class="fw-bold fs-3 text-center">Nilai Tes</p>
                    <div class="col-md-4">
                        <h1 class="display-1 text-primary">{{ $testResult->score }}</h1>
                    </div>
                    <div class="col">
                        @if ($testResult->test->id == 1)
                            @if ($testResult->score >= 0 && $testResult->score <= 7)
                                <h3 class="fw-bold">Kecemasan minimal</h3>
                            @elseif ($testResult->score >= 8 && $testResult->score <= 15)
                                <h3 class="fw-bold">Kecemasan ringan</h3>
                            @elseif ($testResult->score >= 16 && $testResult->score <= 25)
                                <h3 class="fw-bold">Kecemasan moderat</h3>
                            @elseif ($testResult->score >= 26 && $testResult->score <= 63)
                                <h3 class="fw-bold">Kecemasan berat</h3>
                            @endif
                        @elseif($testResult->test->id == 2)
                            @if ($testResult->score >= 0 && $testResult->score <= 6)
                                <h3 class="fw-bold">Sehat</h3>
                            @elseif($testResult->score >= 7 && $testResult->score <= 29)
                                <h3 class="fw-bold">Tidak Sehat</h3>
                            @endif
                        @elseif($testResult->test->id == 3)
                            @if ($testResult->score >= 0 && $testResult->score <= 10)
                                <h3 class="fw-bold">Pasang Surut ini dianggap Normal</h3>
                            @elseif($testResult->score >= 11 && $testResult->score <= 16)
                                <h3 class="fw-bold">Gangguan Mood Ringan</h3>
                            @elseif($testResult->score >= 17 && $testResult->score <= 20)
                                <h3 class="fw-bold">Depresi Klinis di Ambang Batas</h3>
                            @elseif($testResult->score >= 21 && $testResult->score <= 30)
                                <h3 class="fw-bold">Depresi Sedang</h3>
                            @elseif($testResult->score >= 31 && $testResult->score <= 40)
                                <h3 class="fw-bold">Depresi Berat</h3>
                            @elseif($testResult->score > 40)
                                <h3 class="fw-bold">Depresi Ekstrim</h3>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <form action="/tes-mental/konselor/hasil-tes?testResult_id={{ $testResult->testResult_uuid }}" method="post">
            @csrf

            <label for="penjelasan" class="fw-bold mb-3">Hasil Analisis</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="hasil_analisis" id="penjelasan"
                    style="height: 200px"></textarea>
                <label for="penjelasan">Hasil Analisis</label>
            </div>

            <label for="solusi" class="fw-bold mb-3">Saran</label>
            <div class="form-floating row mb-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="saran" id="solusi" style="height: 200px"></textarea>
                <label for="solusi">Saran</label>
            </div>

            <div class="d-grid row">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
