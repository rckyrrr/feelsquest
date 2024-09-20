@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid p-5 bg-white">

        <div class="mb-5">
            <div class="text-center">
                @if (Auth::user()->foto == null)
                    <i class="bi bi-person-circle text-primary display-1" id="icon"></i>
                @else
                    <img src="{{ asset('image_uploaded/image_user/' . $user->foto) }}" alt="" class="profile-img mb-3">
                @endif
                <h1 class="mb-4 mt-3">{{ $user->name }}</h1>
                <p class="text-id">UserID : {{ $user->uuid }}</p>
            </div>
        </div>
        @if ($user->user_type == 'user')
            <div class="row mb-3">
                <div class="col">
                    <div class="mb-3">
                        <p class="fw-bold">Email</p>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Gender</p>
                        @if ($user->gender == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->gender }}</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Umur</p>
                        @if ($user->umur == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->umur }}</p>
                        @endif
                    </div>


                </div>

                <div class="col">
                    <div class="mb-3">
                        <p class="fw-bold">Nomor Telepon</p>
                        <p>{{ $user->phone_number }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Kota</p>
                        @if ($user->kota == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->kota }}</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Pekerjaan</p>
                        @if ($user->pekerjaan == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->pekerjaan }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/editprofile/{{ $user->user_type }}?user_id={{ $user->uuid }}"
                        class="btn btn-primary w-100"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                </div>
            </div>
        @elseif($user->user_type == 'konselor')
            <div class="row mb-3">
                <div class="col">
                    <div class="mb-3">
                        <p class="fw-bold">Email</p>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Gender</p>
                        @if ($user->gender == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->gender }}</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Umur</p>
                        @if ($user->umur == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->umur }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <p class="fw-bold">Keahlian Umum</p>
                        @if ($user->keahlian_utama == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->keahlian_utama }}</p>
                        @endif
                    </div>


                </div>

                <div class="col">
                    <div class="mb-3">
                        <p class="fw-bold">Nomor Telepon</p>
                        <p>{{ $user->phone_number }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Kota</p>
                        @if ($user->kota == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->kota }}</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <p class="fw-bold">Bahasa</p>
                        @if ($user->bahasa == null)
                            <p>-</p>
                        @else
                            <p>{{ $user->bahasa }}</p>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <p class="fw-bold">Keahlian Lainnya</p>
                    @if ($user->keahlian_lainnya == null)
                        <p>-</p>
                    @else
                        <p>{{ $user->keahlian_lainnya }}</p>
                    @endif
                </div>
                <div class="mb-3">
                    <p class="fw-bold">Pendekatan</p>
                    @if ($user->pendekatan == null)
                        <p>-</p>
                    @else
                        <p>{{ $user->pendekatan }}</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a href="/editprofile/{{ $user->user_type }}?user_id={{ $user->uuid }}"
                        class="btn btn-primary w-100"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                </div>

            </div>
        @endif
    </div>
@endsection
