<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feelsbox</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Link Style.CSS -->
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">

    <!-- Link Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="/"><img src="{{ asset('src/logo/Logo and Text/Logo and Text Default.png') }}"
                        alt="" width="150"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-pills mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="btn btn-outline-primary mx-1 border-0" href="/paket">Paket</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary mx-1 border-0" href="/konselor">Konselor</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary mx-1 border-0" href="/test-mental">Test Mental</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary mx-1 border-0" href="/tentang-kami">Tentang Kami</a>
                        </li>
                    </ul>
                    @guest
                        <a href="/login" class="btn btn-primary border-0">Masuk</a>
                    @endguest
                    @auth
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-primary" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item rounded-0" href="/dashboard/{{ auth()->user()->user_type }}">Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item rounded-0 text-danger" href="/logout">Log out</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    @yield('konten')

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-primary text-white">

        <div class="container">
            <div class="row">
                <div class="col-md-4 p-5">
                    <a href="/"><img src="{{ asset('src/logo/Logo and Text/Logo and Text Light.png') }}" alt=""
                        class="img-fluid"></a>
                </div>
                <div class="col"></div>
                <div class="col-md-3 p-5">
                    <div class="mb-2">
                        <b>Layanan</b>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item mb-1">
                            <a href="/paket" class="nav-link">Konseling</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="/test-mental" class="nav-link">Tes Kesehatan Mental</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 p-5">
                    <div class="mb-2">
                        <b>Tentang Kami</b>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item mb-1">
                            <a href="/tentang-kami" class="nav-link">Profil Perusahaan</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="/kontak" class="nav-link">Kontak</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="/gabung" class="nav-link">Gabung Sebagai Konselor</a>
                        </li>
                        <li class="nav-item mb-1">
                            <a href="/FAQ" class="nav-link">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-4 ">
            Copyright © 2023 Feelsbox All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
