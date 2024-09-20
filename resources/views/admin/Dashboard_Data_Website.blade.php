@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-paket-tab" data-bs-toggle="pill" data-bs-target="#pills-paket"
                    type="button" role="tab" aria-controls="pills-paket" aria-selected="true">Paket</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-fitur-tab" data-bs-toggle="pill" data-bs-target="#pills-fitur"
                    type="button" role="tab" aria-controls="pills-fitur" aria-selected="false">Fitur</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-kupon-tab" data-bs-toggle="pill" data-bs-target="#pills-kupon"
                    type="button" role="tab" aria-controls="pills-kupon" aria-selected="false">Kupon</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-faq-tab" data-bs-toggle="pill" data-bs-target="#pills-faq" type="button"
                    role="tab" aria-controls="pills-faq" aria-selected="false">FAQ</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-qotd-tab" data-bs-toggle="pill" data-bs-target="#pills-qotd"
                    type="button" role="tab" aria-controls="pills-qotd" aria-selected="false">QOTD</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-perusahaan-tab" data-bs-toggle="pill" data-bs-target="#pills-perusahaan"
                    type="button" role="tab" aria-controls="pills-perusahaan" aria-selected="false">Data
                    Perusahaan</button>
            </li>

            <!-- Super Admin Only -->
            {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-log-tab" data-bs-toggle="pill" data-bs-target="#pills-log" type="button"
                    role="tab" aria-controls="pills-log" aria-selected="false">Data
                    Log Admin</button>
            </li> --}}

        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-paket" role="tabpanel" aria-labelledby="pills-paket-tab"
                tabindex="0">
                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data Paket</h1>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahPaket">+</button>
                    </div>
                </div>

                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-paket">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Jumlah Sesi</th>
                                <th>Harga</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->total_sessions }}</td>
                                    <td>@rupiah($package->price)</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditPaket{{ $package->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeletePaket{{ $package->id }}">Hapus</a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="DeletePaket{{ $package->id }}" tabindex="-1"
                                            aria-labelledby="DeletePaketLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <h1 class="display-1 text-danger"><i
                                                                class="bi bi-question-circle"></i>
                                                        </h1>
                                                        <div class="my-3">
                                                            <b>Hapus Paket ?</b>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <form action="/deletePackage/{{ $package->id }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="EditPaket{{ $package->id }}" tabindex="-1"
                                            aria-labelledby="EditPaketLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="TambahPaketLabel">Edit Paket</h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/updatePackage/{{ $package->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="my-3">
                                                                <b class="mb-3">Detail Umum</b>

                                                                <p>Icon Paket</p>
                                                                <div class="mb-3">
                                                                    <label class="btn btn-primary">
                                                                        <input type="file" name="icon"
                                                                            id="icon" class="custom-file-input"
                                                                            hidden onchange="preview(event)">
                                                                        <i class="bi bi-upload"></i> Upload
                                                                    </label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="nama_paket" id="nama_paket"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $package->name }}">
                                                                    <label for="nama_paket">Nama Paket</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi"
                                                                        style="height: 100px">{{ $package->description }}</textarea>
                                                                    <label for="deskripsi">Deskripsi</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control"
                                                                        name="jumlah_sesi" id="jumlah_sesi"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $package->total_sessions }}">
                                                                    <label for="jumlah_sesi">Jumlah Sesi</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="number" class="form-control"
                                                                        name="harga_paket" id="harga_paket"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $package->price }}">
                                                                    <label for="harga_paket">Harga</label>
                                                                </div>

                                                                <b>Fitur</b>

                                                                @foreach ($features as $feature)
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            value="{{ $feature->id }}" id="fitur"
                                                                            name="fitur[]"
                                                                            @if (in_array($feature->id, $package->features->pluck('id')->toArray())) checked @endif>
                                                                        <label class="form-check-label" for="fitur">
                                                                            {{ $feature->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach

                                                            </div>

                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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

            <div class="tab-pane fade" id="pills-fitur" role="tabpanel" aria-labelledby="pills-fitur-tab"
                tabindex="0">

                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data Fitur</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahFitur">+</a>
                    </div>
                </div>

                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-fitur">
                        <thead>
                            <tr>
                                <th>Nama Fitur</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $feature)
                                <tr>
                                    <td>{{ $feature->name }}</td>
                                    <td>{{ $feature->description }}</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditFitur{{ $feature->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteFitur{{ $feature->id }}">Inactive</a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="DeleteFitur{{ $feature->id }}" tabindex="-1"
                                            aria-labelledby="DeleteFiturLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <h1 class="display-1 text-danger"><i
                                                                class="bi bi-question-circle"></i></h1>
                                                        <div class="my-3">
                                                            <b>Inactive Fitur ?</b>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <form action="/updateStatusFeature/{{ $feature->id }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Inactive</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="EditFitur{{ $feature->id }}" tabindex="-1"
                                            aria-labelledby="EditFiturLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="EditFiturLabel">Edit Fitur
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/updateFeature/{{ $feature->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="my-3">
                                                                <b class="mb-3">Detail Umum</b>

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <p>Icon Fitur</p>
                                                                        <div class="mb-3">
                                                                            <label class="btn btn-primary">
                                                                                <input type="file" name="icon"
                                                                                    id="icon"
                                                                                    class="custom-file-input" hidden
                                                                                    onchange="previewUpdate(event)">
                                                                                <i class="bi bi-upload"></i> Upload
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8 text-start mb-3">
                                                                        <img id="after" src="#"
                                                                            alt="PreviewUpdate"
                                                                            style="display: none; max-width: 100px;max-height: 100px;">
                                                                    </div>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="name_feature" id="name_feature"
                                                                        value="{{ $feature->name }}">
                                                                    <label for="name_feature">Nama Fitur</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="description"
                                                                        style="height: 100px">{{ $feature->description }}</textarea>
                                                                    <label for="deskripsi">Deskripsi</label>
                                                                </div>

                                                            </div>
                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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

            <div class="tab-pane fade" id="pills-kupon" role="tabpanel" aria-labelledby="pills-kupon-tab"
                tabindex="0">

                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data Kupon</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahKupon">+</a>
                    </div>
                </div>

                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-kupon">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kupon</th>
                                <th>Kode Kupon</th>
                                <th>Masa Berlaku</th>
                                <th>Sisa Pengguanaan</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->start_time }} | {{ $coupon->end_time }}</td>
                                    <td>{{ $coupon->limit }}</td>
                                    <td>{{ $coupon->status_coupon }}</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditKupon{{ $coupon->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteKupon{{ $coupon->id }}">Hapus</a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="DeleteKupon{{ $coupon->id }}" tabindex="-1"
                                            aria-labelledby="DeleteKuponLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <h1 class="display-1 text-danger"><i
                                                                class="bi bi-question-circle"></i></h1>
                                                        <div class="my-3">
                                                            <b>Hapus Kupon {{ $coupon->name }}?</b>
                                                        </div>
                                                        <form action="/deleteCoupon/{{ $coupon->id }}" method="post">
                                                            @csrf
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
                                        <div class="modal fade" id="EditKupon{{ $coupon->id }}" tabindex="-1"
                                            aria-labelledby="TambahKuponLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="TambahKuponLabel">Edit Kupon
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/updateCoupon/{{ $coupon->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="my-3">

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="name" id="name"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $coupon->name }}">
                                                                    <label for="nama_kupon">Nama Kupon*</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="code" id="code"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $coupon->code }}">
                                                                    <label for="kode_kupon">Kode Kupon*</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="nominal" id="nominal"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $coupon->discount }}">
                                                                    <label for="nominal">Nominal Diskon*</label>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="batas" id="batas"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $coupon->limit }}">
                                                                    <label for="batas">Batas Penggunaan*</label>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="date" class="form-control"
                                                                                name="start_time" id="mulai_berlaku"
                                                                                placeholder="name@example.com"
                                                                                value="{{ $coupon->start_time }}">
                                                                            <label for="mulai_berlaku">Mulai
                                                                                Berlaku*</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-floating mb-3">
                                                                            <input type="date" class="form-control"
                                                                                name="end_time" id="akhir_berlaku"
                                                                                placeholder="name@example.com"
                                                                                value="{{ $coupon->end_time }}">
                                                                            <label for="akhir_berlaku">Akhir
                                                                                Berlaku*</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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
            <div class="tab-pane fade" id="pills-faq" role="tabpanel" aria-labelledby="pills-faq-tab" tabindex="0">

                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data FAQ</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahFAQ">+</a>
                    </div>
                </div>


                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-faq">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faq as $f)
                                <tr>
                                    <td>{{ $f->id }}</td>
                                    <td>{{ $f->question }}</td>
                                    <td>{{ $f->answer }}</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditFAQ{{ $f->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteFAQ{{ $f->id }}">Hapus</a>
                                        </div>

                                        <!-- Modal -->
                                        <form action="/deleteFaq/{{ $f->id }}" method="post">
                                            @csrf
                                            <div class="modal fade" id="DeleteFAQ{{ $f->id }}" tabindex="-1"
                                                aria-labelledby="DeleteFAQLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h1 class="display-1 text-danger"><i
                                                                    class="bi bi-question-circle"></i></h1>
                                                            <div class="my-3">
                                                                <b>Hapus FAQ ?</b>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal fade" id="EditFAQ{{ $f->id }}" tabindex="-1"
                                            aria-labelledby="EditFAQLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="EditFAQLabel">Edit FAQ
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/updateFaq/{{ $f->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="my-3">

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="question" id="pertanyaan"
                                                                        value="{{ $f->question }}">
                                                                    <label for="pertanyaan">Pertanyaan</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="answer" id="jawaban"
                                                                        value="{{ $f->answer }}">
                                                                    <label for="jawaban">Jawaban</label>
                                                                </div>
                                                            </div>

                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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
            <div class="tab-pane fade" id="pills-qotd" role="tabpanel" aria-labelledby="pills-qotd-tab" tabindex="0">

                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data QOTD</h1>
                    </div>
                    <div class="col text-end">
                        <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#TambahQOTD">+</a>
                    </div>
                </div>



                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-qotd">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>QOTD</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qotd as $q)
                                <tr>
                                    <td>{{ $q->id }}</td>
                                    <td>{{ $q->qotd }}</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditQOTD{{ $q->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#DeleteQOTD{{ $q->id }}">Hapus</a>
                                        </div>

                                        <!-- Modal -->
                                        <form action="/deleteQOTD/{{ $q->id }}" method="post">
                                            @csrf
                                            <div class="modal fade" id="DeleteQOTD{{ $q->id }}" tabindex="-1"
                                                aria-labelledby="DeleteQOTDLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h1 class="display-1 text-danger"><i
                                                                    class="bi bi-question-circle"></i></h1>
                                                            <div class="my-3">
                                                                <b>Hapus QOTD ?</b>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal fade" id="EditQOTD{{ $q->id }}" tabindex="-1"
                                            aria-labelledby="TambahQOTDLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="TambahQOTDLabel">Edit QOTD
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/updateQOTD/{{ $q->id }}" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="my-3">

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="qotd" id="qotd"
                                                                        value="{{ $q->qotd }}">
                                                                    <label for="qotd">QOTD</label>
                                                                </div>
                                                            </div>

                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
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
            <div class="tab-pane fade" id="pills-perusahaan" role="tabpanel" aria-labelledby="pills-perusahaan-tab"
                tabindex="0">

                <h1 class="mb-3 fw-bold">Data Perusahaan</h1>

                <div class="row shadow p-3 mb-4 bg-white rounded">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold">Detail Perusahaan</h3>
                        </div>
                        <div class="col-md-1">
                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#EditPerusahaan"><i class="bi bi-pencil-square"></i> Edit</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <b>Nama Perusahaan</b>
                                <p>{{ $dataPerusahaan->nama_perusahaan }}</p>
                            </div>

                            <div class="mb-3">
                                <b>Alamat Perusahaan</b>
                                <p>{{ $dataPerusahaan->alamat_perusahaan }}</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <b>Email Perusahaan</b>
                                <p>{{ $dataPerusahaan->email_perusahaan }}</p>
                            </div>

                            <div class="mb-3">
                                <b>Whatsapp Perusahaan</b>
                                <p>{{ $dataPerusahaan->whatsapp_perusahaan }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <b class="mb-2">Deskripsi Perusahaan</b>
                        <p>{{ $dataPerusahaan->deskripsi }}</p>
                    </div>
                </div>



                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold">Data Tim</h3>
                        </div>
                        <div class="col text-end">
                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#TambahAnggota">+ Tambah Anggota Baru</a>
                        </div>
                    </div>
                    <table class="table table-hover" id="table-admin-tim">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTim as $tim)
                                <tr>
                                    <td>{{ $tim->nama }}</td>
                                    <td>{{ $tim->jabatan }}</td>
                                    <td>{{ $tim->divisi }}</td>
                                    <td>
                                        <div class="d-flex gap-5 justify-content-center">
                                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#EditAnggota{{ $tim->id }}">Edit</a>
                                            <a href="#!" class="text-decoration-none text-danger"
                                                data-bs-toggle="modal" data-bs-target="#DeleteTim">Hapus</a>
                                        </div>

                                        <!-- Modal -->
                                        <form action="/deleteTim/{{ $tim->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="modal fade" id="DeleteTim" tabindex="-1"
                                                aria-labelledby="DeleteTimLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h1 class="display-1 text-danger"><i
                                                                    class="bi bi-question-circle"></i></h1>
                                                            <div class="my-3">
                                                                <b>Hapus Tim ?</b>
                                                            </div>
                                                            <div class="d-flex gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-outline-dark"
                                                                    data-bs-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal fade" id="EditAnggota{{ $tim->id }}" tabindex="-1"
                                            aria-labelledby="EditAnggotaLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h3 class="fw-bold" id="EditAnggotaLabel">Edit Anggota
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-2 text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <form action="/editTim/{{ $tim->id }}"
                                                            enctype="multipart/form-data" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="my-3">

                                                                <p>Foto</p>
                                                                <div class="mb-3">
                                                                    <label class="btn btn-primary">
                                                                        <input type="file" name="foto"
                                                                            id="icon" class="custom-file-input"
                                                                            hidden onchange="preview(event)">
                                                                        <i class="bi bi-upload"></i> Upload
                                                                    </label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="nama_anggota" id="nama_anggota"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $tim->nama }}">
                                                                    <label for="nama_anggota">Nama*</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="divisi" id="divisi"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $tim->divisi }}">
                                                                    <label for="divisi">Divisi*</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="jabatan" id="jabatan"
                                                                        placeholder="name@example.com"
                                                                        value="{{ $tim->jabatan }}">
                                                                    <label for="jabatan">Jabatan*</label>
                                                                </div>

                                                                <div class="d-grid">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
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

            <div class="tab-pane fade" id="pills-log" role="tabpanel" aria-labelledby="pills-log-tab" tabindex="0">
                <div class="row">
                    <div class="col">
                        <h1 class="fw-bold">Data Log Admin</h1>
                    </div>
                </div>

                <div class="row shadow p-5 mb-4 bg-white rounded">
                    <table class="table table-hover" id="table-admin-log">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin</th>
                                <th>Timeframe</th>
                                <th class="text-center">Action</th>
                                <th>Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mbak Yeyen</td>
                                <td>24/12/2023 09:00</td>
                                <td>Add Paket</td>
                                <td>Paket 2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Tambah Paket -->
    <div class="modal fade" id="TambahPaket" tabindex="-1" aria-labelledby="TambahPaketLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahPaketLabel">Tambah Paket Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addPackage" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <b class="mb-3">Detail Umum</b>

                            <p>Icon Paket</p>
                            <div class="mb-3">
                                <label class="btn btn-primary">
                                    <input type="file" name="icon" id="icon" class="custom-file-input" hidden
                                        onchange="preview(event)">
                                    <i class="bi bi-upload"></i> Upload
                                </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama_paket" id="nama_paket"
                                    placeholder="name@example.com">
                                <label for="nama_paket">Nama Paket</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi"
                                    style="height: 100px"></textarea>
                                <label for="deskripsi">Deskripsi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="jumlah_sesi" id="jumlah_sesi"
                                    placeholder="name@example.com">
                                <label for="jumlah_sesi">Jumlah Sesi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="harga_paket" id="harga_paket"
                                    placeholder="name@example.com">
                                <label for="harga_paket">Harga</label>
                            </div>

                            <b>Fitur</b>

                            @foreach ($features as $feature)
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="{{ $feature->id }}"
                                        id="fitur" name="fitur[]">
                                    <label class="form-check-label" for="fitur">
                                        {{ $feature->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Fitur -->
    <div class="modal fade" id="TambahFitur" tabindex="-1" aria-labelledby="TambahFiturLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahFiturLabel">Tambah Fitur Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addFeature" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">
                            <b class="mb-3">Detail Umum</b>

                            <div class="row">
                                <div class="col-md-4">
                                    <p>Icon Fitur</p>
                                    <div class="mb-3">
                                        <label class="btn btn-primary">
                                            <input type="file" name="icon" id="icon"
                                                class="custom-file-input" hidden onchange="previewImage(event)">
                                            <i class="bi bi-upload"></i> Upload
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8 text-start mb-3">
                                    <img id="preview" src="#" alt="Preview"
                                        style="display: none; max-width: 100px;max-height: 100px;">
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name_feature" id="name_feature"
                                    placeholder="name@example.com">
                                <label for="name_feature">Nama Fitur</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="description"
                                    style="height: 100px"></textarea>
                                <label for="deskripsi">Deskripsi</label>
                            </div>

                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kupon -->
    <div class="modal fade" id="TambahKupon" tabindex="-1" aria-labelledby="TambahKuponLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahKuponLabel">Tambah Kupon Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addCoupon" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="name@example.com">
                                <label for="nama_kupon">Nama Kupon*</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="code" id="code"
                                    placeholder="name@example.com">
                                <label for="kode_kupon">Kode Kupon*</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nominal" id="nominal"
                                    placeholder="name@example.com">
                                <label for="nominal">Nominal Diskon*</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="batas" id="batas"
                                    placeholder="name@example.com">
                                <label for="batas">Batas Penggunaan*</label>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="start_time" id="mulai_berlaku"
                                            placeholder="name@example.com">
                                        <label for="mulai_berlaku">Mulai Berlaku*</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" name="end_time" id="akhir_berlaku"
                                            placeholder="name@example.com">
                                        <label for="akhir_berlaku">Akhir Berlaku*</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah FAQ -->
    <div class="modal fade" id="TambahFAQ" tabindex="-1" aria-labelledby="TambahFAQLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahFAQLabel">Tambah FAQ Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addFaq" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="question" id="pertanyaan">
                                <label for="pertanyaan">Pertanyaan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="answer" id="jawaban">
                                <label for="jawaban">Jawaban</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah QOTD -->
    <div class="modal fade" id="TambahQOTD" tabindex="-1" aria-labelledby="TambahQOTDLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahQOTDLabel">Tambah QOTD Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addQOTD" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="qotd" id="qotd">
                                <label for="qotd">QOTD</label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Data Perusahaan -->
    <div class="modal fade" id="EditPerusahaan" tabindex="-1" aria-labelledby="EditPerusahaanLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahFiturLabel">Data Perusahaan</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/editDataPerusahaan" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="my-3">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                                    placeholder="name@example.com" value="{{ $dataPerusahaan->nama_perusahaan }}">
                                <label for="nama_perusahaan">Nama Perusahaan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="deskripsi" name="deskripsi"
                                    style="height: 100px">{{ $dataPerusahaan->deskripsi }}</textarea>
                                <label for="deskripsi">Deskripsi</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email_perusahaan" id="email_perusahaan"
                                    placeholder="name@example.com" value="{{ $dataPerusahaan->email_perusahaan }}">
                                <label for="email_perusahaan">Email Perusahaan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="whatsapp_perusahaan"
                                    id="whatsapp_perusahaan" placeholder="name@example.com"
                                    value="{{ $dataPerusahaan->whatsapp_perusahaan }}">
                                <label for="whatsapp_perusahaan">Whatsapp Perusahaan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="alamat" name="alamat_perusahaan"
                                    style="height: 100px">{{ $dataPerusahaan->alamat_perusahaan }}</textarea>
                                <label for="alamat">Alamat Perusahaan</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Anggota -->
    <div class="modal fade" id="TambahAnggota" tabindex="-1" aria-labelledby="TambahAnggotaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="fw-bold" id="TambahAnggotaLabel">Tambah Anggota Baru</h3>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="/addTim" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="my-3">

                            <p>Foto</p>
                            <div class="mb-3">
                                <label class="btn btn-primary">
                                    <input type="file" name="foto" id="icon" class="custom-file-input"
                                        hidden onchange="preview(event)">
                                    <i class="bi bi-upload"></i> Upload
                                </label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="nama_anggota" id="nama_anggota"
                                    placeholder="name@example.com">
                                <label for="nama_anggota">Nama*</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="divisi" id="divisi"
                                    placeholder="name@example.com">
                                <label for="divisi">Divisi*</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="jabatan" id="jabatan"
                                    placeholder="name@example.com">
                                <label for="jabatan">Jabatan*</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewUpdate(event) {
            var input = event.target;
            var after = document.getElementById('after');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    after.style.display = 'block';
                    after.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function() {
            $('#table-admin-paket').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-fitur').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-faq').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-qotd').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-tim').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-log').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-admin-kupon').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
