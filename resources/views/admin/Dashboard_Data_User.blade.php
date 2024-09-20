@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <div class="row shadow p-5 mb-4 bg-white rounded text-center">
            <div class="col-md-6 border-end">
                <b>Total Klien</b>
                <h1 class="fw-bold">{{ $total_user->count() }}</h1>
                {!! $chart->container() !!}

                <script src="{{ $chart->cdn() }}"></script>

                {{ $chart->script() }}

            </div>
            <div class="col-md-6">
                <div class="">
                    <b>Total Konselor</b>
                    <h1 class="fw-bold">{{ $total_counselor->count() }}</h1>
                    {!! $counselor_chart->container() !!}

                    <script src="{{ $counselor_chart->cdn() }}"></script>

                    {{ $counselor_chart->script() }}
                </div>

            </div>
        </div>



        <div class="row mb-4">
            <div class="col">
                <h1 class="fw-bold">Data User</h1>
            </div>

            <div class="col text-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah User</button>
            </div>
        </div>

        <div class="row shadow p-5 mb-4 bg-white rounded">
            <table class="table table-hover" id="table-admin-user">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Klien</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_user as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                <div class="d-flex gap-5 justify-content-center">
                                    @if ($user->user_type == 'konselor')
                                        <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#updateKonselor{{ $user->id }}">Edit</a>
                                    @elseif($user->user_type == 'admin')
                                        <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#updateAdmin{{ $user->id }}">Edit</a>
                                    @endif
                                    @if ($user->user_type == 'admin' || $user->user_type == 'konselor' || $user->user_type == 'user')
                                        <a href="#!" class="text-decoration-none text-danger" data-bs-toggle="modal"
                                            data-bs-target="#DeleteUser{{ $user->id }}">Hapus</a>
                                    @endif
                                </div>

                                <!-- Modal -->
                                <form action="/inactiveUser/{{ $user->id }}" method="post">
                                    @csrf
                                    <div class="modal fade" id="DeleteUser{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="DeleteUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <h1 class="display-1 text-danger"><i class="bi bi-question-circle"></i>
                                                    </h1>
                                                    <div class="my-3">
                                                        <b>Hapus User {{ $user->name }}</b>
                                                    </div>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button type="button" class="btn btn-outline-dark"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="updateKonselor{{ $user->id }}" tabindex="-1"
                            aria-labelledby="EditFiturLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="fw-bold" id="EditFiturLabel">Edit {{ $user->user_type }}
                                                </h3>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <form action="/updateCounselor/{{ $user->id }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <p>Foto Profil</p>
                                                <label class="btn btn-primary">
                                                    <input type="file" name="foto" id="icon"
                                                        class="custom-file-input" hidden onchange="previewUpdate(event)">
                                                    <i class="bi bi-upload"></i> Upload
                                                </label>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nomor_izin"
                                                            name="nomor_izin" placeholder="name@example.com"
                                                            value="{{ $user->izin_konselor }}">
                                                        <label for="nomor_izin">Nomor Izin Konselor<b
                                                                class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="npwp"
                                                            name="npwp" placeholder="name@example.com"
                                                            value="{{ $user->npwp }}">
                                                        <label for="npwp">NPWP<b class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" placeholder="name@example.com"
                                                            value="{{ $user->name }}">
                                                        <label for="username">Username<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="slug_name"
                                                            name="slug_name" placeholder="name@example.com"
                                                            value="{{ $user->slug_user }}">
                                                        <label for="slug_name">Slug Name<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="name@example.com"
                                                            value="{{ $user->email }}">
                                                        <label for="email">Email<b class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="nomor_telepon"
                                                            name="nomor_telepon" placeholder="name@example.com"
                                                            value="{{ $user->phone_number }}">
                                                        <label for="nomor_telepon">Nomor Telepon<b
                                                                class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <b>Nama</b>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="gelar_depan"
                                                            name="gelar_depan" placeholder="name@example.com"
                                                            value="{{ $user->gelar_depan }}">
                                                        <label for="gelar_depan">Gelar Depan<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nama_depan"
                                                            name="nama_depan" placeholder="name@example.com"
                                                            value="{{ $user->nama_depan }}">
                                                        <label for="nama_depan">Nama Depan<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nama_belakang"
                                                            name="nama_belakang" placeholder="name@example.com"
                                                            value="{{ $user->nama_belakang }}">
                                                        <label for="nama_belakang">Nama Belakang<b
                                                                class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="gelar_belakang"
                                                            name="gelar_belakang" placeholder="name@example.com"
                                                            value="{{ $user->gelar_belakang }}">
                                                        <label for="gelar_belakang">Gelar Belakang<b
                                                                class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <b>Identitas</b>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="umur"
                                                            name="umur" placeholder="name@example.com"
                                                            value="{{ $user->umur }}">
                                                        <label for="umur">Umur<b class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="bahasa"
                                                            name="bahasa" placeholder="name@example.com"
                                                            value="{{ $user->bahasa }}">
                                                        <label for="bahasa">Bahasa<b class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                                            Keahlian
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="keahlian_utama" name="keahlian_utama"
                                                                    placeholder="name@example.com"
                                                                    value="{{ $user->keahlian_utama }}">
                                                                <label for="keahlian_utama">Keahlian Utama<b
                                                                        class="text-danger">*</b>
                                                                </label>
                                                            </div>

                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="keahlian_lainnya" name="keahlian_lainnya"
                                                                    placeholder="name@example.com"
                                                                    value="{{ $user->keahlian_lainnya }}">
                                                                <label for="keahlian_lainnya">Keahlian Lainnya<b
                                                                        class="text-danger">*</b> </label>
                                                            </div>

                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="pendekatan" name="pendekatan"
                                                                    placeholder="name@example.com"
                                                                    value="{{ $user->pendekatan }}">
                                                                <label for="pendekatan">Pendekatan<b
                                                                        class="text-danger">*</b>
                                                                </label>
                                                            </div>
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
                        <div class="modal fade" id="updateAdmin{{ $user->id }}" tabindex="-1"
                            aria-labelledby="EditFiturLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="fw-bold" id="EditFiturLabel">Edit {{ $user->user_type }}
                                                </h3>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <form action="/updateAdmin/{{ $user->id }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" placeholder="name@example.com"
                                                            value="{{ $user->name }}">
                                                        <label for="username">Username<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="slug_name"
                                                            name="slug_name" placeholder="name@example.com"
                                                            value="{{ $user->slug_user }}">
                                                        <label for="slug_name">Slug Name<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <b>Nama</b>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nama_depan"
                                                            name="nama_depan" placeholder="name@example.com"
                                                            value="{{ $user->nama_depan }}">
                                                        <label for="nama_depan">Nama Depan<b class="text-danger">*</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="nama_belakang"
                                                            name="nama_belakang" placeholder="name@example.com"
                                                            value="{{ $user->nama_belakang }}">
                                                        <label for="nama_belakang">Nama Belakang<b
                                                                class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="email"
                                                            name="email" placeholder="name@example.com"
                                                            value="{{ $user->email }}">
                                                        <label for="email">Email<b class="text-danger">*</b> </label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating mb-3">
                                                        <input type="number" class="form-control" id="nomor_telepon"
                                                            name="nomor_telepon" placeholder="name@example.com"
                                                            value="{{ $user->phone_number }}">
                                                        <label for="nomor_telepon">Nomor Telepon<b
                                                                class="text-danger">*</b>
                                                        </label>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <div class="col">
                            <h3 class="fw-bold" id="exampleModalLabel">Tambah User Baru</h3>
                        </div>
                        <div class="col text-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                    <b>Detail Umum</b>
                    <div class="row mb-3 p-2" id="pills-tab" role="tablist">
                        <button class="col w-100 btn btn-outline-primary active" id="pills-profile-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                            aria-controls="pills-profile" aria-selected="false">Konselor</button>

                        <!-- Ini cuman buat super Admin aja -->
                        @if (Auth::user()->user_type == 'superadmin')
                            <button class="col w-100 btn btn-outline-primary" id="pills-contact-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab"
                                aria-controls="pills-contact" aria-selected="false">Admin</button>
                        @endif
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab" tabindex="0">
                            <form action="/addCounselor" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <p>Foto Profil</p>
                                    <label class="btn btn-primary">
                                        <input type="file" name="foto" id="icon" class="custom-file-input"
                                            hidden onchange="previewUpdate(event)">
                                        <i class="bi bi-upload"></i> Upload
                                    </label>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nomor_izin" name="nomor_izin"
                                                placeholder="name@example.com">
                                            <label for="nomor_izin">Nomor Izin Konselor<b class="text-danger">*</b>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="npwp" name="npwp"
                                                placeholder="name@example.com">
                                            <label for="npwp">NPWP<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="name@example.com">
                                            <label for="username">Username<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="slug_name" name="slug_name"
                                                placeholder="name@example.com">
                                            <label for="slug_name">Slug Name<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com">
                                            <label for="email">Email<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="nomor_telepon"
                                                name="nomor_telepon" placeholder="name@example.com">
                                            <label for="nomor_telepon">Nomor Telepon<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <b>Nama</b>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="gelar_depan"
                                                name="gelar_depan" placeholder="name@example.com">
                                            <label for="gelar_depan">Gelar Depan<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_depan" name="nama_depan"
                                                placeholder="name@example.com">
                                            <label for="nama_depan">Nama Depan<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_belakang"
                                                name="nama_belakang" placeholder="name@example.com">
                                            <label for="nama_belakang">Nama Belakang<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="gelar_belakang"
                                                name="gelar_belakang" placeholder="name@example.com">
                                            <label for="gelar_belakang">Gelar Belakang<b class="text-danger">*</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <b>Identitas</b>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="umur" name="umur"
                                                placeholder="name@example.com">
                                            <label for="umur">Umur<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="bahasa" name="bahasa"
                                                placeholder="name@example.com">
                                            <label for="bahasa">Bahasa<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Keahlian
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="keahlian_utama"
                                                        name="keahlian_utama" placeholder="name@example.com">
                                                    <label for="keahlian_utama">Keahlian Utama<b class="text-danger">*</b>
                                                    </label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="keahlian_lainnya"
                                                        name="keahlian_lainnya" placeholder="name@example.com">
                                                    <label for="keahlian_lainnya">Keahlian Lainnya<b
                                                            class="text-danger">*</b> </label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="pendekatan"
                                                        name="pendekatan" placeholder="name@example.com">
                                                    <label for="pendekatan">Pendekatan<b class="text-danger">*</b>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab" tabindex="0">

                            <form action="/addAdmin" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="name@example.com">
                                            <label for="username">Username<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="slug_name" name="slug_name"
                                                placeholder="name@example.com">
                                            <label for="slug_name">Slug Name<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <b>Nama</b>
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_depan" name="nama_depan"
                                                placeholder="name@example.com">
                                            <label for="nama_depan">Nama Depan<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="nama_belakang"
                                                name="nama_belakang" placeholder="name@example.com">
                                            <label for="nama_belakang">Nama Belakang<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="name@example.com">
                                            <label for="email">Email<b class="text-danger">*</b> </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="nomor_telepon"
                                                name="nomor_telepon" placeholder="name@example.com">
                                            <label for="nomor_telepon">Nomor Telepon<b class="text-danger">*</b>
                                            </label>
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
        </div>
    </div>

    {{-- <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-admin-user').DataTable({
                "order": [],
            });
        });
    </script>
@endsection
