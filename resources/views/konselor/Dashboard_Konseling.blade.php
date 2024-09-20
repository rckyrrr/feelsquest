@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Dashboard Konseling</h1>
        </div>

        <div class="row gap-4 text-center">
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Klien</b>
                <h1 class="fw-bold">{{ $totalKlien }}</h1>
                <b>{{ $persentasePerubahan }}% dibanding bulan lalu</b>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Sesi Terjadwal</b>
                <h1 class="fw-bold">{{ $totalScheduled }}</h1>
                <b>{{ $persentasePerubahanScheduled }}% dibanding bulan lalu</b>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <b>Total Sesi Selesai</b>
                <h1 class="fw-bold">{{ $totalCompleted }}</h1>
                <b>{{ $persentasePerubahanCompleted }}% dibanding bulan lalu</b>
            </div>
        </div>

        <div class="row gap-4">
            <div class="col-md-8 shadow p-5 mb-4 bg-white rounded">
                <h3 class="fw-bold">Jadwal</h3>
                <div class="d-flex mb-3" id="pills-tab" role="tablist">
                    <div class="col">
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
                        <table id="table-konselor-berlangsung" class="table table-hover table-depresi">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Klien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalCounseling as $jadwal)
                                    @if ($jadwal->status_counseling == 'ongoing')
                                        <tr>
                                            <td>{{ $jadwal->klien->name }}</td>
                                            <td>{{ date('d F Y', strtotime($jadwal->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($jadwal->counseling_start)) }} -
                                                {{ date('H:i', strtotime($jadwal->counseling_end)) }}</td>
                                            <td>
                                                <p class="btn btn-warning" style="color:white;">
                                                    {{ strtoupper($jadwal->status_counseling) }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-5 justify-content-center">
                                                    <a href="{{ $jadwal->link_meet }}" class="text-decoration-none"
                                                        target="_blank">Join Room</a>
                                                    <a href="/konseling/konselor/sesi-konseling?counseling_id={{ $jadwal->counselingUUID }}"
                                                        class="text-decoration-none ms-2">Catatan</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($jadwal->status_counseling == 'scheduled')
                                        <tr>
                                            <td>{{ $jadwal->klien->name }}</td>
                                            <td>{{ date('d F Y', strtotime($jadwal->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($jadwal->counseling_start)) }} -
                                                {{ date('H:i', strtotime($jadwal->counseling_end)) }}</td>
                                            <td>
                                                <p class="btn btn-primary" style="color:white;">
                                                    {{ strtoupper($jadwal->status_counseling) }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#buatSesi{{ $jadwal->counselingUUID }}"
                                                        class="text-decoration-none">Buat Sesi Konseling</a>
                                                    <a href="/konseling/konselor/detail-konseling?counseling_id={{ $jadwal->counselingUUID }}"
                                                        class="text-decoration-none">Cek Pra Konseling</a>
                                                </div>
                                            </td>
                                            <div class="modal fade" id="buatSesi{{ $jadwal->counselingUUID }}"
                                                tabindex="-1" aria-labelledby="buatSesi" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h1 class="display-1 text-primary"><i
                                                                    class="bi bi-question-circle"></i></h1>
                                                            <div class="my-3">
                                                                <b>Buat Sesi Konseling : {{ $jadwal->counselingUUID }}?</b>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <a href="/createSession?counseling_id={{ $jadwal->counselingUUID }}"
                                                                    class="btn btn-primary">Buat</a>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade show" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab"
                        tabindex="0">
                        <table id="table-konselor-selesai" class="table table-hover table-depresi">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Klien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalCounseling as $jadwal)
                                    @if ($jadwal->status_counseling == 'completed')
                                        <tr>
                                            <td>{{ $jadwal->klien->name }}</td>
                                            <td>{{ date('d F Y', strtotime($jadwal->counseling_date)) }}</td>
                                            <td>{{ date('H:i', strtotime($jadwal->counseling_start)) }} -
                                                {{ date('H:i', strtotime($jadwal->counseling_end)) }}</td>
                                            <td>
                                                <p class="btn btn-success" style="color:white;">
                                                    {{ strtoupper($jadwal->status_counseling) }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-5 justify-content-center">
                                                    <a href="/konseling/konselor/detail-konseling?counseling_id={{ $jadwal->counselingUUID }}"
                                                        class="text-decoration-none">Cek Detil</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col shadow p-5 mb-4 bg-white rounded">
                <div class="row">
                    <div class="col">
                        <h3 class="fw-bold">Jadwal Sibuk</h3>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#JamSibuk"><i
                                class="bi bi-plus"></i></a>

                        <!-- Modal Jam Sibuk -->
                        <div class="modal fade" id="JamSibuk" tabindex="-1" aria-labelledby="JamSibukLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col text-start">
                                                <h3 class="fw-bold" id="DataGajiLabel">Tambah Jadwal Sibuk</h3>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <form action="/addJadwalSibuk" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" class="form-control" id="tanggal"
                                                            placeholder="name@example.com" name="tanggal">
                                                        <label for="tanggal">Masukkan Tanggal</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select" id="floatingSelect"
                                                            aria-label="Floating label select example" name="jam">
                                                            @for ($i = 7; $i < 21; $i++)
                                                                <option
                                                                    value="{{ $i . '.00' }} - {{ $i + 1 . '.00' }}">
                                                                    {{ $i . '.00' }} -
                                                                    {{ $i + 1 . '.00' }}
                                                                </option>
                                                                <option
                                                                    value="{{ $i . '.30' }} - {{ $i + 1 . '.30' }}">
                                                                    {{ $i . '.30' }} -
                                                                    {{ $i + 1 . '.30' }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                        <label for="floatingSelect">Pilih Jam</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-primary p-3">Tambah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Jam Sibuk -->

                    </div>
                </div>
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($jadwalSibuk as $dataSibuk)
                                <tr>
                                    <td>{{ date('d F Y', strtotime($dataSibuk->jadwal_date)) }}</td>
                                    <td>{{ $dataSibuk->jadwal_time }}</td>
                                    <td class="text-center">
                                        <a href="#!" class="link-danger text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#DeleteJamSibuk{{ $dataSibuk->id }}"><i
                                                class="bi bi-crose"></i>X</a>

                                        <!-- Modal Delete Jam Sibuk-->
                                        <div class="modal fade" id="DeleteJamSibuk{{ $dataSibuk->id }}" tabindex="-1"
                                            aria-labelledby="DeleteJamSibukLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <form action="/deleteJadwalSibuk/{{ $dataSibuk->id }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <h1 class="display-1 text-danger"><i
                                                                    class="bi bi-question-circle"></i>
                                                            </h1>
                                                            <div class="my-3">
                                                                <b>Hapus Jam Sibuk ?</b>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal Delete Jam Sibuk-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-konselor-berlangsung').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-konselor-selesai').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
