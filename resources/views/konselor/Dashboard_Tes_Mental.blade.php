@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Dashboard Tes Mental</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Permintaan Analisis</b>
                <h1 class="fw-bold">{{ $totalTestResult }}</h1>

            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Analisis Selesai</b>
                <h1 class="fw-bold">{{ $completedTestResult }}</h1>

            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Permintaan Analisis Saat ini</b>
                <h1 class="fw-bold">{{ $noTestResult }}</h1>

            </div>
        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <h3 class="fw-bold">Analisis Tes Mental</h3>

            <div class="d-flex mb-3" id="pills-tab" role="tablist">
                <div class="col me-3">
                    <button class="btn btn-outline-primary w-100 active" id="pills-belum-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-belum" type="button" role="tab" aria-controls="pills-belum"
                        aria-selected="false">Belum Dianalisis</button>
                </div>
                <div class="col">
                    <button class="btn btn-outline-primary w-100" id="pills-sudah-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-sudah" type="button" role="tab" aria-controls="pills-sudah"
                        aria-selected="false">Sudah Dianalisis</button>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-belum" role="tabpanel" aria-labelledby="pills-belum-tab"
                    tabindex="0">
                    <table class="table table-hover" id="table-konselor-tes-belum">
                        <thead>
                            <tr>
                                <th>Nama Klien</th>
                                <th>Jenis Tes</th>
                                <th>Tanggal</th>
                                <th>Skor</th>
                                <th class="text-center">Analisis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testResult as $result)
                                @if ($result->status_result == 'withCounselor')
                                    <tr>
                                        <td>{{ $result->klien->name }}</td>
                                        <td>{{ $result->test->name }}</td>
                                        <td>{{ date('d F Y'), strtotime($result->created_at) }}</td>
                                        <td>{{ $result->score }}</td>
                                        <td>
                                            <div class="d-flex gap-5 justify-content-center">
                                                @if ($result->solusi == null)
                                                    <a href="/tes-mental/konselor/perkembangan?testResult_id={{ $result->testResult_uuid }}"
                                                        class="text-decoration-none">Perkembangan</a>
                                                @endif
                                                @if ($result->saran == null)
                                                    <a href="/tes-mental/konselor/hasil-tes?testResult_id={{ $result->testResult_uuid }}"
                                                        class="text-decoration-none">Tes</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-sudah" role="tabpanel" aria-labelledby="pills-sudah-tab"
                    tabindex="0">
                    <table class="table table-hover" id="table-konselor-tes-sudah">
                        <thead>
                            <tr>
                                <th>Nama Klien</th>
                                <th>Jenis Tes</th>
                                <th>Tanggal</th>
                                <th>Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testResult as $result)
                                @if ($result->status_result == 'completed')
                                    <tr>
                                        <td>{{ $result->klien->name }}</td>
                                        <td>{{ $result->test->name }}</td>
                                        <td>{{ date('d F Y'), strtotime($result->created_at) }}</td>
                                        <td>{{ $result->score }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-konselor-tes-sudah').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-konselor-tes-belum').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
