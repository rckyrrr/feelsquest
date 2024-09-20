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

<body class="bg-login">

    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="/"><img src="{{ asset('src/logo/Logo Text Only/Text Only Default.png') }}" alt=""
                        width="150"></a>
            </div>
    </div>
    </nav>
    </div>

    <div class="col-md-3 position-absolute top-50 start-50 translate-middle text-center">
        <h1 class="fw-bold">Hola!</h1>
        <p>Selamat Datang di Feelbox</p>
        @if (Request::is('registrasi'))
            <form action="/registrasi" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email"
                        value="{{ session('email') }}">
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="floatingInput"
                        placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="phone_number" id="floatingInput"
                        placeholder="Email">
                    <label for="floatingInput">Nomor Telepon</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 ">Registrasi</button>
            </form>
        @else
            @if (session('otp_verif'))
                <form action="/otp" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="token" id="floatingInput" placeholder="OTP">
                        <label for="floatingInput">OTP</label>
                        @if (session('wrong_otp'))
                            <p style="color:red;">{{ session('wrong_otp') }}</p>
                        @endif
                        <p class="mt-3">Kode OTP telah dikirim ke Email kamu. Cek ya!</p>
                        <div id="countdown"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 ">Submit</button>
                </form>
            @else
                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput"
                            placeholder="Email">
                        <label for="floatingInput">Email</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 ">Login</button>
                </form>
            @endif
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // Tanggal dan waktu target countdown (misalnya, 31 Desember 2023 pukul 00:00:00)
        var targetDate = moment("{{ session('otp_expired') }}");

        // Perbarui countdown setiap detik
        var countdown = setInterval(function() {
            var currentDate = moment();
            var duration = moment.duration(targetDate.diff(currentDate));

            // Hitung sisa waktu dalam jam, menit, dan detik
            var hours = duration.hours();
            var minutes = duration.minutes();
            var seconds = duration.seconds();

            // Tampilkan hasil countdown di elemen dengan ID "countdown"
            document.getElementById("countdown").innerHTML = minutes + ":" + seconds +
                "";

            // Hentikan countdown jika waktu target telah tercapai
            if (duration <= 0) {
                clearInterval(countdown);
                removeSession(['email', 'otp_verif', 'otp_expired']);

                function removeSession(keys) {
                    // Lakukan permintaan ke server untuk menghapus session
                    fetch('/remove-session', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ganti dengan token CSRF yang sesuai
                        },
                        body: JSON.stringify({
                            keys: keys
                        })
                    });
                }
                window.location.reload();
            }
        }, 1000);
    </script>
</body>

</html>
