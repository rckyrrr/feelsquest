@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid p-5 bg-white">

        <form action="/editedprofile/user?user_id={{ $user->uuid }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <div class="text-center">
                    @if ($user->foto == null)
                        <label class="pointer">
                            <img src="" alt="" id="preview" class="profile-img mb-3">
                            <i class="bi bi-person-circle text-primary display-1" id="icon-person"></i>
                            <input type="file" name="foto" id="foto" class="custom-file-input" hidden>
                        </label>
                    @else
                        <label class="pointer">
                            <img src="{{ asset('image_uploaded/image_user/' . $user->foto) }}" alt="" id="previews"
                                class="profile-img mb-3">
                            <input type="file" name="foto" id="foto-update" class="custom-file-input" hidden>
                        </label>
                    @endif
                    <div class="d-flex justify-content-center">
                        <input type="text" class="form-control" id="nama" name="username"
                            aria-describedby="emailHelp" style="width: 50%;" value="{{ $user->name }}">
                    </div>
                    <p class="text-id">UserID : {{ $user->uuid }}</p>
                </div>
            </div>
            @if ($user->user_type == 'user')
                <div class="row mb-3">
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-bold">Email</p>
                            <input type="email" class="form-control" id="nama" name="email"
                                aria-describedby="emailHelp" value="{{ $user->email }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Gender</p>
                            <select class="form-select" aria-label="Default select example" name="gender">
                                <option selected hidden>Jenis Kelamin</option>
                                <option value="Pria" @if ($user->gender == 'Pria') selected @endif>Pria</option>
                                <option value="Wanita" @if ($user->gender == 'Wanita') selected @endif>Wanita</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Umur</p>
                            <input type="number" class="form-control" id="nama" name="umur"
                                aria-describedby="emailHelp" value="{{ $user->umur }}">
                        </div>

                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-bold">Nomor Telepon</p>
                            <input type="text" class="form-control" id="nama" name="nomer_hp"
                                aria-describedby="emailHelp" value="{{ $user->phone_number }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Kota</p>
                            <input type="text" class="form-control" id="nama" name="kota"
                                aria-describedby="emailHelp" value="{{ $user->kota }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Pekerjaan</p>
                            <input type="text" class="form-control" id="nama" name="pekerjaan"
                                aria-describedby="emailHelp" value="{{ $user->pekerjaan }}">
                        </div>
                    </div>
                </div>
            @elseif ($user->user_type == 'konselor')
                <div class="row mb-3">
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-bold">Email</p>
                            <input type="email" class="form-control" id="nama" name="email"
                                aria-describedby="emailHelp" value="{{ $user->email }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Gender</p>
                            <select class="form-select" aria-label="Default select example" name="gender">
                                <option selected hidden>Jenis Kelamin</option>
                                <option value="Pria" @if ($user->gender == 'Pria') selected @endif>Pria</option>
                                <option value="Wanita" @if ($user->gender == 'Wanita') selected @endif>Wanita</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Umur</p>
                            <input type="number" class="form-control" id="nama" name="umur"
                                aria-describedby="emailHelp" value="{{ $user->umur }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Keahlian Umum</p>
                            <input type="text" class="form-control" id="nama" name="keahlian_utama"
                                aria-describedby="emailHelp" value="{{ $user->keahlian_utama }}">
                        </div>

                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-bold">Nomor Telepon</p>
                            <input type="text" class="form-control" id="nama" name="nomer_hp"
                                aria-describedby="emailHelp" value="{{ $user->phone_number }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Kota</p>
                            <input type="text" class="form-control" id="nama" name="kota"
                                aria-describedby="emailHelp" value="{{ $user->kota }}">
                        </div>

                        <div class="mb-3">
                            <p class="fw-bold">Bahasa</p>
                            <input type="text" class="form-control" id="nama" name="bahasa"
                                aria-describedby="emailHelp" value="{{ $user->bahasa }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keahlian_lainnya" class="form-label fw-bold">Keahlian Lainnya</label>
                        <textarea class="form-control" id="keahlian_lainnya" name="keahlian_lainnya" rows="2">{{ $user->keahlian_lainnya }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pendekatan" class="form-label fw-bold">Pendekatan</label>
                        <textarea class="form-control" id="pendekatan" rows="2" name="pendekatan">{{ $user->pendekatan }}</textarea>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
                <div class="col">
                    <a href="/profile/{{ $user->user_type }}" class="btn btn-outline-danger w-100">Batal</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $('#preview').hide();
        $(document).ready(function() {
            $('#foto').change(function() {
                var file = this.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').show();
                    $('#icon-person').hide();
                    $('#preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });
        });

        $(document).ready(function() {
            $('#foto-update').change(function() {
                var file = this.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previews').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
