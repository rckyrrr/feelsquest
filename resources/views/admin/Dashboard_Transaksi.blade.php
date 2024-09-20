@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="mb-3">
            <h1 class="fw-bold">Data Transaksi</h1>
        </div>

        <div class="shadow p-3 mb-5 bg-white rounded">
            <table class="table table-hover" id="table-admin-transaksi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Paket</th>
                        <th>Nama User</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTransaksi as $data)
                        <tr>
                            <td>1</td>
                            <td>{{ $data->package->name }}</td>
                            <td>{{ $data->klien->name }}</td>
                            <td>
                                <a href="#!"
                                    class="btn @if ($data->transaction_status == 'pending') btn-danger
@elseif ($data->transaction_status == 'ongoing')
btn-warning
@elseif ($data->transaction_status == 'completed')
btn-primary @endif">{{ $data->transaction_status }}</a>
                            </td>
                            <td>
                                <div class="d-flex gap-5 justify-content-center">

                                    <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#DataTransaksi{{ $data->id }}">View</a>

                                </div>

                                <!-- Modal Data Transaksi -->
                                <div class="modal fade" id="DataTransaksi{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="DataTransaksiLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <h3 class="fw-bold" id="DataTransaksiLabel">Detail Transaksi</h3>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <b>Informasi Umum</b>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>ID Transaksi</b>
                                                        <p>{{ $data->transactionUUID }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Status</b>
                                                        <p>{{ $data->transaction_status }}</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Paket</b>
                                                        <p>{{ $data->package->name }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Tanggal Transaksi</b>
                                                        <p>{{ date('d F Y', strtotime($data->created_at)) }}</p>
                                                    </div>
                                                </div>




                                                <div class="mb-3">
                                                    <b>Klien</b>

                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Nama</b>
                                                        <p>{{ $data->klien->name }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Umur</b>
                                                        <p>{{ $data->klien->umur }}</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Gender</b>
                                                        <p>{{ $data->klien->gender }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Pekerjaan</b>
                                                        <p>{{ $data->klien->pekerjaan }}</p>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <b>Sesi Konseling</b>
                                                </div>

                                                <div class="mb-2">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>ID Sesi</th>
                                                                <th>Tanggal</th>
                                                                <th>Jam</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data->counseling as $counseling)
                                                                <tr>
                                                                    <td>{{ $counseling->counselingUUID }}</td>
                                                                    <td>{{ date('d F Y', strtotime($counseling->counseling_date)) }}
                                                                    </td>
                                                                    <td>{{ date('H:i', strtotime($counseling->counseling_start)) }}
                                                                    </td>
                                                                    <td><a href="#!" class="text-decoration-none"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#DetailSesi">Lihat
                                                                            Detail</a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Detail Sesi -->
                                <div class="modal fade" id="DetailSesi" tabindex="-1" aria-labelledby="DetailSesiLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <h3 class="fw-bold" id="DataTransaksiLabel">Detail Sesi</h3>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <b>Informasi Umum</b>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>ID Konseling</b>
                                                        <p>1234789034323</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Status</b>
                                                        <p>Selesai</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Tanggal Konseling</b>
                                                        <p>21 Januari 2001</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Jam Konseling</b>
                                                        <p>07.30</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Link Room</b>
                                                        <p>Meet.google.com</p>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <b>Konselor</b>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Nama</b>
                                                        <p>Mbak Yeyen</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Keahlian Utama</b>
                                                        <p>Keluarga</p>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <b>Pendekatan</b>
                                                        <p>Pendekatan A</p>
                                                    </div>
                                                    <div class="col">
                                                        <b>Telah Mendukung Konseling Sejak</b>
                                                        <p>2021</p>
                                                    </div>
                                                </div>

                                                <p class="fw-bold">Feedback Konseling</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae in
                                                    quidem eaque asperiores, perspiciatis impedit ea facilis fuga vel
                                                    soluta.
                                                    Architecto ex impedit omnis dignissimos autem iusto repellat,
                                                    consectetur
                                                    animi, sint nisi id accusamus voluptates nesciunt explicabo quas
                                                    voluptatibus dolorem laboriosam quo nam accusantium nobis doloremque
                                                    ducimus
                                                    quisquam ullam! Recusandae ratione neque aperiam aliquid saepe illum
                                                    hic,
                                                    mollitia eligendi omnis iste alias cum soluta reiciendis qui aut dicta
                                                    laboriosam nemo? Omnis cupiditate quia voluptatem earum delectus alias
                                                    inventore nisi aperiam, commodi dolores tempore sint vero ad sapiente
                                                    consequuntur ratione ut ipsum, illum assumenda eum esse beatae adipisci
                                                    velit expedita. Labore!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-admin-transaksi').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
