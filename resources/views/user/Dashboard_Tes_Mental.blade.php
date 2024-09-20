@extends('template.Dashboard_Template')

@section('konten')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <div class="container-fluid px-5">
        <div class="text-start mb-4">
            <h1 class="fw-bold">Halo, {{ auth()->user()->name }}</h1>
        </div>
        <p class="mb-3">Let's Track Your Feeling!</p>

        <div class="row shadow p-4 mb-3 bg-white rounded text-center">
            <h2 class="fw-bold">Tes Kesehatan Mental</h2>
            <p>"{{ cache('qotd') }}"</p>
        </div>

        <div class="row gap-4">
            @foreach ($tests as $test)
                <div class="col shadow p-4 mb-4 bg-white rounded text-center">
                    <p class="fw-bold">{{ $test->name }}</p>
                    @php
                        $tesUser = null;
                        foreach ($test->result as $tes) {
                            if ($tes->klien_id == Auth::user()->id) {
                                $tesUser = $tes;
                            }
                        }
                    @endphp

                    @if ($tesUser)
                        @if ($tesUser->test_id == 1)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 7)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Kecemasan Minimal</p>
                            @elseif($tesUser->score >= 8 && $tesUser->score <= 15)
                                <p class="display-3"><i class="bi bi-emoji-laughing"></i></p>
                                <p class="fw-bold">Kecemasan Ringan</p>
                            @elseif($tesUser->score >= 16 && $tesUser->score <= 25)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i></p>
                                <p class="fw-bold">Kecemasan Moderat</p>
                            @elseif($tesUser->score >= 26 && $tesUser->score <= 63)
                                <p class="display-3"><i class="bi bi-emoji-smile-upside-down"></i></p>
                                <p class="fw-bold">Kecemasan Berat</p>
                            @endif
                        @elseif ($tesUser->test_id == 2)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 6)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Sehat</p>
                            @elseif($tesUser->score >= 7 && $tesUser->score <= 29)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i> </p>
                                <p class="fw-bold">Tidak Sehat</p>
                            @endif
                        @elseif ($tesUser->test_id == 3)
                            @if ($tesUser->score >= 0 && $tesUser->score <= 10)
                                <p class="display-3"><i class="bi bi-emoji-heart-eyes"></i></p>
                                <p class="fw-bold">Pasang Surut ini dianggap Normal</p>
                            @elseif($tesUser->score >= 11 && $tesUser->score <= 16)
                                <p class="display-3"><i class="bi bi-emoji-laughing"></i></p>
                                <p class="fw-bold">Gangguan Mood Ringan</p>
                            @elseif($tesUser->score >= 17 && $tesUser->score <= 20)
                                <p class="display-3"><i class="bi bi-emoji-smile"></i></p>
                                <p class="fw-bold">Depresi Klinis di Ambang Batas</p>
                            @elseif($tesUser->score >= 21 && $tesUser->score <= 30)
                                <p class="display-3"><i class="bi bi-emoji-neutral"></i></p>
                                <p class="fw-bold">Depresi Sedang</p>
                            @elseif($tesUser->score >= 31 && $tesUser->score <= 40)
                                <p class="display-3"><i class="bi bi-emoji-expressionless"></i></p>
                                <p class="fw-bold">Depresi Berat</p>
                            @elseif($tesUser->score > 40)
                                <p class="display-3"><i class="bi bi-emoji-smile-upside-down"></i></p>
                                <p class="fw-bold">Depresi Ekstrim</p>
                            @endif
                        @endif
                        <p class="fw-bold">Total Skor Kamu : {{ $tesUser->score }} / @if ($tesUser->test_id == 1 || $tesUser->test_id == 3)
                                63
                            @elseif ($tesUser->test_id == 2)
                                29
                            @endif
                        </p>
                        <a href="/test?test_id={{ $test->test_uuid }}" class="btn btn-outline-primary w-100">Tes
                            Sekarang</a>
                    @else
                        <p class="display-3"><i class="bi bi-clipboard-data"></i></p>
                        <p class="fw-bold">Lakukan Tes Untuk Mendapatkan Skor</p>
                        <a href="/test?test_id={{ $test->test_uuid }}" class="btn btn-outline-primary w-100">Tes
                            Sekarang</a>
                    @endif



                </div>
            @endforeach

        </div>

        <div class="row shadow p-4 mb-4 bg-white rounded">
            <div class="d-flex mb-3">
                <div class="col">
                    <h3 class="fw-bold mb-3">Grafik Perkembangan Mental</h3>
                </div>
            </div>

            <ul class="nav nav-pills mb-3 gap-3" id="pills-tab" role="tablist">
                @foreach ($tests as $index => $test)
                    <li class="nav-item" role="presentation">
                        <button class="btn btn-outline-primary{{ $loop->first ? ' active' : '' }}"
                            id="pills-{{ $test->id }}-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-{{ $test->id }}" type="button" role="tab"
                            aria-controls="pills-{{ $test->id }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">Tingkat {{ $test->name }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach ($tests as $index => $test)
                    <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }}" id="pills-{{ $test->id }}"
                        role="tabpanel" aria-labelledby="pills-{{ $test->id }}-tab" tabindex="0">
                        <div class="text-end">
                            <a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#Selengkapnya{{ $test->id }}"><i class="bi bi-arrow-right"></i>
                                Selengkapnya</a>
                        </div>
                        <!-- Modal Selengkapnya -->
                        <div class="modal fade" id="Selengkapnya{{ $test->id }}" tabindex="-1"
                            aria-labelledby="SelengkapnyaLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body px-4">
                                        <div class="row mb-3">
                                            <div class="col text-end">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <div class=" mx-auto text-center mb-3">
                                            <h2 class="fw-bold">Grafik Perkembangan {{ $test->name }}
                                            </h2>
                                            <div id="grafik-test-{{ $test->id }}{{ $index }}">
                                                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                                <script>
                                                    var chartTest{{ $test->id }} = new ApexCharts(document.querySelector(
                                                        "#grafik-test-{{ $test->id }}{{ $index }}"), {
                                                        chart: {
                                                            type: 'line', // Jenis grafik (misalnya line, bar, pie)
                                                            height: 350, // Tinggi grafik dalam pixel
                                                            // ... tambahkan opsi lain yang diperlukan
                                                        },
                                                        series: [{
                                                            name: '{{ $test->name }}', // Nama seri data
                                                            data: [
                                                                @foreach ($test->result as $result)
                                                                    @if ($result->klien_id == Auth::user()->id)

                                                                        {{ $result->score }},
                                                                    @endif
                                                                @endforeach
                                                            ] // Nilai-nilai seri data
                                                        }],
                                                        stroke: {
                                                            curve: 'smooth' // Menggunakan kurva yang halus
                                                        }
                                                        // ... tambahkan opsi grafik lainnya
                                                    });
                                                    chartTest{{ $test->id }}.render();
                                                </script>
                                            </div>
                                        </div>

                                        @php
                                            $penjelasanSingkat = null;
                                            $solusi = null;
                                            foreach ($test->result as $r) {
                                                if ($r->test_id == $test->id && $r->klien_id == Auth::user()->id && $r->status_result == 'completed') {
                                                    $penjelasanSingkat = $r->penjelasan_singkat;
                                                    $solusi = $r->solusi;
                                                }
                                            }
                                        @endphp

                                        <h2 class="fw-bold mb-3">Penjelasan Singkat</h2>
                                        <p>
                                            @if ($penjelasanSingkat !== null)
                                                {{ $penjelasanSingkat }}
                                            @else
                                                Data belum dianalisis oleh konselor.
                                            @endif
                                        </p>

                                        <h2 class="fw-bold mb-3">Solusi Umum Terkait Masalahmu</h2>
                                        <p>
                                            @if ($solusi !== null)
                                                {{ $solusi }}
                                            @else
                                                Data belum dianalisis oleh konselor.
                                            @endif
                                        </p>

                                        <p>lakukan tes ulang setiap 2 minggu untuk dapat melihat
                                            perkembangan kondisi kamu</p>

                                        <a href="/test-mental" class="btn btn-outline-primary">Tes
                                            Ulang</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Selengkapnya -->
                        <div class="row mb-5">
                            <div class="col-md-10 mx-auto" id="grafik-depresi-{{ $test->id }}">
                                @if ($loop->first)
                                    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                    <script>
                                        var chart{{ $test->id }} = new ApexCharts(document.querySelector("#grafik-depresi-{{ $test->id }}"), {
                                            chart: {
                                                type: 'line',
                                                height: 350,
                                                // ... add other necessary options
                                            },
                                            series: [{
                                                    name: 'Skor {{ $test->name }}',

                                                    data: [
                                                        @foreach ($test->result as $result)
                                                            @if ($result->klien_id == Auth::user()->id)

                                                                {{ $result->score }},
                                                            @endif
                                                        @endforeach
                                                    ]
                                                }

                                            ],
                                            stroke: {
                                                curve: 'smooth' // Menggunakan kurva yang halus
                                            }
                                        });
                                        chart{{ $test->id }}.render();
                                    </script>
                                @endif
                            </div>
                        </div>
                        <table id="table-{{ $test->id }}" class="table table-hover table-{{ $test->id }}">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Skor</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($test->result as $result)
                                    @if ($result->test_id == $test->id && $result->klien_id == Auth::user()->id)
                                        <tr>
                                            <td>{{ date('d F Y', strtotime($result->created_at)) }}</td>
                                            <td>{{ $result->score }}</td>
                                            <td><a href="#!" class="text-decoration-none" data-bs-toggle="modal"
                                                    data-bs-target="#HasilTes{{ $result->id }}">Cek Hasil</a> <a
                                                    href="#!" class="text-decoration-none ms-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#AnalisisTes{{ $result->id }}">Hasil Analisis</a>
                                            </td>
                                        </tr>
                                        <!-- Modal Hasil Tes -->
                                        <div class="modal fade" id="HasilTes{{ $result->id }}" tabindex="-1"
                                            aria-labelledby="HasilTesLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body px-4">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <h3 class="fw-bold">Hasil {{ $test->name }}</h3>
                                                            </div>
                                                            <div class="col text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            @if ($test->id == 1)
                                                                @if ($result->score <= 7)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-heart-eyes"></i></h1>
                                                                        <h2 class="fw-bold">Sehat</h2>
                                                                    </div>
                                                                    <div class="progress mb-3" role="progressbar"
                                                                        aria-label="Basic example" aria-valuenow="50"
                                                                        aria-valuemin="0" aria-valuemax="67">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ ($result->score / 63) * 100 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Tes Beck Anxiety Inventory, yang lebih dikenal
                                                                            dengan singkatan BAI, adalah sebuah tes
                                                                            psikologis yang dirancang untuk menilai tingkat
                                                                            kecemasan seseorang. Seolah-olah kita sedang
                                                                            menjelajahi peta emosi kita sendiri, alat ini
                                                                            membantu kita mengidentifikasi seberapa besar
                                                                            kecemasan yang kita rasakan dan bagaimana hal
                                                                            tersebut memengaruhi kehidupan kita. Dan kabar
                                                                            baiknya adalah, hasil tes BAI terbaru kamu telah
                                                                            tiba dan penuh dengan berita positif!
                                                                            Seperti menemukan sinar matahari di pagi hari
                                                                            yang cerah, hasil tes BAI kamu menunjukkan bahwa
                                                                            kamu berada di level normal. Itu artinya,
                                                                            tingkat kecemasan kamu sejalan dengan apa yang
                                                                            dialami oleh kebanyakan orang. Tentu saja, ini
                                                                            adalah berita yang cerah dan penuh harapan. Kamu
                                                                            menunjukkan bahwa kamu memiliki kemampuan yang
                                                                            baik dalam mengelola perasaannya. Selamat!
                                                                            Keberhasilan ini bukanlah akhir dari perjalanan,
                                                                            melainkan awal dari perjalanan baru yang lebih
                                                                            positif dan sehat. Mari lanjutkan kehidupan ini
                                                                            dengan penuh semangat dan optimisme. Bravo!
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($result->score >= 8 && $result->score <= 15)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-laughing"></i></h1>
                                                                        <h2 class="fw-bold">Tingkat Rendah</h2>
                                                                    </div>
                                                                    <div class="progress mb-3" role="progressbar"
                                                                        aria-label="Basic example" aria-valuenow="50"
                                                                        aria-valuemin="0" aria-valuemax="67">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ ($result->score / 63) * 100 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Beck Anxiety Inventory, atau BAI, adalah semacam
                                                                            perangkat navigasi pribadi untuk jalan pikiran
                                                                            kita. Menyediakan 'peta mental' yang dapat
                                                                            membantu kita mengenali dan mengukur tingkat
                                                                            kecemasan seseorang. Seperti kapal membutuhkan
                                                                            bintang untuk navigasi, pikiran kita juga perlu
                                                                            BAI untuk berorientasi. Nah, kabar baiknya,
                                                                            setelah melewati perjalanan yang cemerlang dalam
                                                                            tes ini, seorang klien kita telah muncul dengan
                                                                            hasil yang mencerminkan tingkat kecemasan
                                                                            ringan. Ini hanyalah seolah-olah kamu sedang
                                                                            merasakan sedikit gugup sebelum melakukan
                                                                            presentasi atau mungkin sebelum tampil pada
                                                                            acara yang penting. Jadi, tidak ada yang perlu
                                                                            dikhawatirkan! Ini adalah langkah awal dalam
                                                                            perjalanan penemuan diri, dan kita semua tahu,
                                                                            setiap perjalanan dimulai dengan satu langkah
                                                                            kecil. Yuk, lanjutkan perjalanan ini dengan
                                                                            semangat dan keceriaan!
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($result->score >= 16 && $result->score <= 25)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-neutral"></i></h1>
                                                                        <h2 class="fw-bold">Tingkat Sedang</h2>
                                                                    </div>
                                                                    <div class="progress mb-3" role="progressbar"
                                                                        aria-label="Basic example" aria-valuemin="0"
                                                                        aria-valuemax="100">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ ($result->score / 63) * 100 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Tes Beck Anxiety Inventory (BAI) adalah alat yang
                                                                            menarik, yang diciptakan untuk mengukur tingkat
                                                                            kecemasan seseorang. Layaknya sebuah ramalan
                                                                            cuaca, BAI mengukur 'iklim emosional' kita.
                                                                            Sekarang, giliran salah satu Feelsquad yang ‘cek
                                                                            cuaca emosional'! Ternyata, hasilnya menunjukkan
                                                                            bahwa kamu berada di zona kecemasan sedang. Ini
                                                                            seperti hari yang mendung tanpa hujan. Jangan
                                                                            panik dulu, teman-teman. Ini berarti, perasaan
                                                                            cemas dalam situasi tertentu adalah hal yang
                                                                            wajar, seperti sebelum berbicara di depan umum
                                                                            atau saat menunggu hasil yang penting. Itulah
                                                                            pesona kehidupan, selalu penuh dengan misteri
                                                                            dan petualangan. Jadi, mari kita terus melangkah
                                                                            dan memahami perjalanan emosional kita dengan
                                                                            semangat yang tinggi! karena setiap langkah yang
                                                                            kita ambil adalah langkah menuju pemahaman diri
                                                                            yang lebih baik. Jika kecemasan mengganggu hidup
                                                                            kamu, kamu bisa meminta bantuan kepada para ahli
                                                                            di bidang kecemasan di Feelsbox yang dapat
                                                                            membantu kamu mengatasi perubahan suasana hati.
                                                                            Mari hadapi hidup ini dengan senyuman!
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($result->score >= 26 && $result->score <= 63)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-smile-upside-down"></i>
                                                                        </h1>
                                                                        <h2 class="fw-bold">Tingkat Berat</h2>
                                                                    </div>
                                                                    <div class="progress mb-3" role="progressbar"
                                                                        aria-label="Basic example" aria-valuenow="50"
                                                                        aria-valuemin="0" aria-valuemax="100">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ ($result->score / 63) * 100 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Tes Beck Anxiety Inventory (BAI) adalah tes
                                                                            canggih yang sering digunakan oleh para psikolog
                                                                            untuk mengukur tingkat kecemasan seseorang. Tes
                                                                            ini seperti sebuah peta yang memandu kita
                                                                            menelusuri dunia emosional internal seseorang,
                                                                            memberikan kita gambaran yang cukup jelas dan
                                                                            akurat tentang apa yang mereka rasakan.
                                                                            Sekarang, beralih ke pembahasan utama kita,
                                                                            seorang Feelsquad yang luar biasa, yang akan
                                                                            kita sebut sebagai "Bintang", baru saja
                                                                            menyelesaikan tes ini. Hasilnya, oh, sungguh
                                                                            mengejutkan! Bintang mendapatkan skor yang
                                                                            mencerminkan tingkat kecemasan yang cukup berat.
                                                                            Sekarang, kita bisa memahami masalah kamu dengan
                                                                            lebih baik, bukan? Tapi jangan khawatir, ini
                                                                            bukanlah akhir dari cerita, melainkan awal yang
                                                                            baru. Di tengah hujan kecemasan, Bintang
                                                                            sekarang bisa mendapatkan payung pengobatan yang
                                                                            tepat, sehingga ia bisa menari dengan riang di
                                                                            tengah hujan, mengubahnya menjadi pelangi!
                                                                            Tapi bukan hanya itu saja! Feelsbox juga dapat
                                                                            mengatur sesi konseling dan dukungan yang
                                                                            berkelanjutan, sebuah perjalanan bersama menuju
                                                                            langit biru yang lebih cerah! Tidak hanya itu,
                                                                            Feelsbox juga akan memperkenalkan kamu pada
                                                                            berbagai teknik relaksasi seperti meditasi atau
                                                                            olahraga yang disarankan oleh ahli dari
                                                                            Feelsbox, yang akan mengajak kamu untuk bermain
                                                                            dengan aliran pikiran dan tubuh kamu untuk
                                                                            menghasilkan keharmonisan perasaan.

                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @elseif ($test->id == 2)
                                                                @php
                                                                    $count1 = 0;
                                                                    foreach (json_decode($result->answer) as $index => $answer) {
                                                                        if ($index >= 0 && $index <= 28) {
                                                                            if ($answer == 1) {
                                                                                $count1 += 1;
                                                                            }
                                                                        }
                                                                    }
                                                                    $count2 = 0;
                                                                    foreach (json_decode($result->answer) as $index => $answer) {
                                                                        if ($index == 20) {
                                                                            if ($answer == 1) {
                                                                                $count2 += 1;
                                                                            }
                                                                        }
                                                                    }
                                                                    $count3 = 0;
                                                                    foreach (json_decode($result->answer) as $index => $answer) {
                                                                        if ($index >= 21 && $index <= 23) {
                                                                            if ($answer == 1) {
                                                                                $count3 += 1;
                                                                            }
                                                                        }
                                                                    }
                                                                    $count4 = 0;
                                                                    foreach (json_decode($result->answer) as $index => $answer) {
                                                                        if ($index >= 24 && $index <= 28) {
                                                                            if ($answer == 1) {
                                                                                $count4 += 1;
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                @if ($count1 < 6)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-smile"></i></h1>
                                                                        <h2 class="fw-bold">Sehat</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Feelsquad sungguh sehat dan bersemangat, terbukti
                                                                            dari hasil tes SRQ yang menggembirakan! Tes SRQ,
                                                                            singkatan dari Self-Reporting Questionnaire,
                                                                            adalah sebuah metode evaluasi yang digunakan
                                                                            untuk mengukur tingkat gangguan psikologis pada
                                                                            seseorang. Dalam tes ini, Feelsquad dengan
                                                                            sukacita dan bersemangat mengisi
                                                                            pertanyaan-pertanyaan yang dirancang secara
                                                                            khusus untuk mengungkapkan kondisi mental dan
                                                                            emosional mereka. Hasil yang luar biasa ini
                                                                            menegaskan bahwa Feelsquad memiliki kestabilan
                                                                            emosional yang luar biasa dan jiwa yang ceria.
                                                                            Kami dengan penuh sukacita melihat Feelsquad
                                                                            melangkah maju dengan keyakinan dan semangat
                                                                            yang membara!
                                                                        </p>
                                                                    </div>
                                                                @elseif ($count1 >= 6)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-neutral"></i></h1>
                                                                        <h2 class="fw-bold">Butuh Bantuan Psikolog</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Pertama-tama, Tes SRQ, singkatan dari
                                                                            Self-Reporting Questionnaire, adalah sebuah
                                                                            metode evaluasi yang digunakan untuk mengukur
                                                                            tingkat gangguan psikologis pada seseorang. SRQ
                                                                            diciptakan oleh World Health Organization untuk
                                                                            mengidentifikasi masalah psikologis secara
                                                                            objektif dan efisien. Oke, sekarang mari kita
                                                                            beralih ke Feelsquad yang luar biasa ini.
                                                                            Menurut hasil SRQ yang ceria dan informatif ini,
                                                                            tampaknya ada beberapa hal menarik yang bisa
                                                                            kita jelajahi bersama. kamu telah menunjukkan
                                                                            beberapa respons yang menunjukkan bahwa kamu
                                                                            mungkin menghadapi beberapa tantangan psikologis
                                                                            yang unik.
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($count2 == 1)
                                                                    <div class="mb-3">
                                                                        <p>Feelsquad yang dinamis ini, berdasarkan hasil
                                                                            dari SRQ, telah menunjukkan beberapa
                                                                            petunjuk yang menarik. Ada indikasi bahwa
                                                                            mereka mungkin telah bereksperimen dengan
                                                                            beberapa zat psikoaktif. Hey, bukan berarti
                                                                            ini sesuatu yang harus ditakuti atau
                                                                            malu-maluin! Sebaliknya, Justru ini
                                                                            menawarkan peluang emas untuk belajar dan
                                                                            menumbuhkan pemahaman yang lebih baik
                                                                            tentang diri kamu tentang dampak dari zat
                                                                            tersebut terhadap pengalaman psikologis kamu
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($count3 > 1)
                                                                    <div class="mb-3">
                                                                        <p>Sejauh ini, Feelsquad yang super keren ini
                                                                            telah membagikan beberapa informasi menarik
                                                                            melalui SRQ. Ada beberapa indikasi bahwa
                                                                            kamu sedang menghadapi tantangan psikologis
                                                                            yang unik, termasuk beberapa aspek psikotik.
                                                                            Tenang, ini bukan masalah, Memahami hal ini
                                                                            dapat menjadi langkah awal dari suatu
                                                                            perjalanan yang asik menuju kesehatan mental
                                                                            yang lebih baik. Pertama, kita bisa mulai
                                                                            dengan merencanakan sesi bersama seorang
                                                                            profesional yang berpengalaman dalam
                                                                            kesehatan mental yang dapat membantu
                                                                            memahami dan menjelajahi pengalaman ini
                                                                            dalam suasana yang aman dan mendukung.
                                                                            Selanjutnya, teknik-teknik seperti meditasi,
                                                                            olahraga, dan diet seimbang bisa menjadi
                                                                            tambahan yang berarti untuk mendukung
                                                                            perjalanan kamu.
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                                @if ($count4 > 1)
                                                                    <div class="mb-3">
                                                                        <p>Hasil SRQ kamu menandakan bahwa kamu
                                                                            kemungkinan mengalami sesuatu yang dikenal
                                                                            sebagai PTSD, atau disebut juga dengan
                                                                            Gangguan Stres Pasca Trauma. Namun, jangan
                                                                            khawatir, ini bukanlah akhir dari cerita,
                                                                            ini adalah awal dari sebuah perjalanan baru.
                                                                            Mengenal lebih jauh tentang PTSD adalah
                                                                            langkah pertama dalam menghadapi tantangan
                                                                            ini. Dengan semangat positif dan dorongan
                                                                            untuk terus maju, kami akan membantumu
                                                                            membangun strategi pemulihan yang tepat.
                                                                            Kita bisa mulai dengan mencari dukungan
                                                                            profesional, seperti psikolog, yang dapat
                                                                            memberikan bimbingan yang dibutuhkan.
                                                                            Kemudian, Kamu juga bisa mencoba untuk
                                                                            membiasakan diri dengan melakukan
                                                                            kegiatan-kegiatan yang sehat seperti
                                                                            meditasi, olahraga teratur, dan menjaga pola
                                                                            makan yang sehat ke dalam keseharianmu.
                                                                            Menjalin hubungan sosial juga penting, jadi
                                                                            menghabiskan waktu dengan orang yang
                                                                            dicintai juga bisa sangat membantu.
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @elseif ($test->id == 3)
                                                                @if ($result->score >= 0 && $result->score <= 10)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-heart-eyes"></i></h1>
                                                                        <h2 class="fw-bold">Sehat</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Beck Depression Inventory, atau BDI, adalah alat
                                                                            yang hebat yang diciptakan untuk mengukur
                                                                            tingkat depresi seseorang. Anggap saja BDI
                                                                            seperti barometer kebahagiaan, yang memberikan
                                                                            petunjuk penting tentang suasana hati seseorang.
                                                                            Nah, kabar baik datang dari hasil BDI Anda. Kamu
                                                                            ternyata termasuk dalam kategori 'normal', yang
                                                                            berarti suasana hatinya seperti sinar cerah di
                                                                            pagi hari. Kebahagiaan melimpah dalam hidup
                                                                            kamu, dengan skor BDI yang positif ini, itu
                                                                            menunjukkan bahwa kamu menjaga keseimbangan
                                                                            emosional yang sehat. Keadaan ini seolah-olah
                                                                            menunjukkan bahwa hidup Anda penuh dengan
                                                                            warna-warna cerah dan menyenangkan! Jadi, mari
                                                                            kita beri tepuk tangan meriah untuk Feelsquad
                                                                            yang luar biasa ini!
                                                                        </p>
                                                                    </div>
                                                                @elseif ($result->score >= 11 && $result->score <= 16)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-laughing"></i></h1>
                                                                        <h2 class="fw-bold">Gangguan Mood Ringan</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Sebelum kita mulai, mari kita bahas tentang
                                                                            pahlawan
                                                                            cerita kita hari ini - tes Beck Depression
                                                                            Inventory
                                                                            (BDI)
                                                                            . Tes BDI adalah alat yang dirancang dengan
                                                                            cerdas yang membantu kita memahami berbagai
                                                                            aspek
                                                                            emosional dan perilaku individu. Menurut hasil
                                                                            yang
                                                                            menarik ini, Feelsquad mengalami perubahan
                                                                            suasana
                                                                            hati yang ringan. Tidak ada yang perlu
                                                                            dikhawatirkan! Seperti ombak di pantai pada hari
                                                                            yang cerah, suasana hati kita semua bisa naik
                                                                            dan
                                                                            turun, dan kamu pun begitu. langkah selanjutnya
                                                                            adalah menentukan rencana aksi! Mengatasi mood
                                                                            yang
                                                                            naik turun bisa dilakukan dengan berbagai cara.
                                                                            Pertama, cobalah metode relaksasi, seperti
                                                                            meditasi
                                                                            atau yoga. Kedua, mengeksplorasi hobi atau minat
                                                                            bisa menjadi ide yang bagus. Terakhir, konseling
                                                                            atau terapi dengan seorang profesional dapat
                                                                            menjadi
                                                                            pilihan yang tepat. Bayangkan berbicara dengan
                                                                            seorang teman yang berpengetahuan luas dan penuh
                                                                            pengertian yang siap membantu Anda melewati
                                                                            setiap
                                                                            rintangan dan tantangan.
                                                                        </p>
                                                                    </div>
                                                                @elseif ($result->score >= 17 && $result->score <= 20)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-smile"></i></h1>
                                                                        <h2 class="fw-bold">Ambang Batas Normal</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Tes Beck Depression Inventory (BDI), yang lucu
                                                                            saja,
                                                                            itu semacam alat 'deteksi dini' dalam dunia
                                                                            psikologi yang membantu kita melihat sejauh mana
                                                                            mood kita berada dalam spektrum depresi.
                                                                            Kabar terbaru dari BDI tentang Feelsquad cukup
                                                                            mengejutkan! Ceritanya, Feelsquad sedang berada
                                                                            di
                                                                            ambang batas depresi. Seolah-olah berdiri di
                                                                            tepi
                                                                            kolam renang, memperdebatkan apakah akan terjun
                                                                            atau
                                                                            tidak. Tapi, hei, jangan khawatir! Kita semua
                                                                            tahu
                                                                            bahwa deteksi dini adalah kuncinya. Jadi, ini
                                                                            sebenarnya adalah kabar baik. Kami dapat
                                                                            membantu
                                                                            kamu untuk memastikan bahwa kamu tidak terjun ke
                                                                            kolam renang dan memilih untuk duduk di tepi
                                                                            kolam
                                                                            renang sambil menikmati minuman yang
                                                                            menyegarkan.
                                                                            Kami siap dengan serangkaian solusi yang akan
                                                                            membantu kamu menjauh dari ambang batas dan
                                                                            kembali
                                                                            ke padang rumput yang hijau nan indah.
                                                                        </p>
                                                                    </div>
                                                                @elseif ($result->score >= 21 && $result->score <= 30)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-neutral"></i></h1>
                                                                        <h2 class="fw-bold">Tingkat Sedang</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Tes Beck Depression Inventory, atau yang sering
                                                                            disebut BDI, adalah tes yang terkenal untuk
                                                                            mengukur
                                                                            tingkat depresi. Ya, seperti termometer yang
                                                                            mengukur suhu, BDI mengukur bagaimana perasaan
                                                                            kita.
                                                                            Nah, kami punya kabar baik untuk salah satu
                                                                            Feelsquad kita ini. Hasil BDI-nya sudah keluar
                                                                            dan
                                                                            menunjukkan bahwa kamu termasuk dalam kategori
                                                                            depresi sedang. Anggap saja ini seperti mendapat
                                                                            nilai B dalam ujian matematika, ini bukan yang
                                                                            terbaik, tapi tentu saja bukan yang terburuk.
                                                                            Meskipun hasil ini mungkin membuat kita berpikir
                                                                            lebih keras, ini adalah langkah pertama yang
                                                                            sangat
                                                                            penting untuk memahami lebih lanjut tentang apa
                                                                            yang
                                                                            sedang terjadi. Sekarang, kita sudah punya
                                                                            petunjuk,
                                                                            mari melangkah maju, manfaatkan informasi ini
                                                                            untuk
                                                                            merencanakan masa depan yang lebih cerah dan
                                                                            penuh
                                                                            harapan. Cheers!
                                                                        </p>
                                                                    </div>
                                                                @elseif ($result->score >= 31 && $result->score <= 40)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-expressionless"></i>
                                                                        </h1>
                                                                        <h2 class="fw-bold">Tingkat Berat</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Beck Depression Inventory (BDI) adalah alat yang
                                                                            dirancang dengan cerdik untuk mengukur tingkat
                                                                            depresi seseorang. Anggap saja ini seperti
                                                                            termometer yang mengukur suhu emosi kita!
                                                                            Sekarang,
                                                                            mari kita bicara tentang klien kami yang baru
                                                                            saja
                                                                            mengikuti tes ini. Kami memahami bahwa Anda
                                                                            telah
                                                                            berjuang keras sepanjang perjalanan hidupmu,
                                                                            mempertanyakan banyak hal, dan mencari jawaban
                                                                            tentang hidup kamu. Berdasarkan hasil BDI kamu,
                                                                            sepertinya kamu berada di zona yang kita sebut
                                                                            sebagai 'depresi berat'. Tapi hei, ini bukanlah
                                                                            akhir dari cerita! Dengan pengetahuan ini, kamu
                                                                            sekarang memiliki kesempatan untuk mendapatkan
                                                                            bantuan yang tepat dan spesifik. Para
                                                                            profesional
                                                                            kesehatan mental yang berpengalaman dapat
                                                                            membantu
                                                                            kamu membangun strategi untuk mengatasi
                                                                            tantangan-tantangan ini. Di sisi lain, ada
                                                                            begitu
                                                                            banyak cara yang dapat membantu kamu merasa
                                                                            lebih
                                                                            baik, seperti terapi, meditasi, olahraga, hobi
                                                                            baru,
                                                                            dan pergaulan yang sehat.
                                                                        </p>
                                                                    </div>
                                                                @elseif ($result->score > 40)
                                                                    <div class="text-center my-3">
                                                                        <h1 class="display-1 text-second"><i
                                                                                class="bi bi-emoji-smile-upside-down"></i>
                                                                        </h1>
                                                                        <h2 class="fw-bold">Tingkat Ekstrim</h2>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <p>Oh betapa mengasyikkannya, seorang Feelsquad,
                                                                            sang petualang hidup, baru saja mendapatkan skor
                                                                            yang cukup tinggi dalam tes BDI! Skor tersebut
                                                                            menunjukkan bahwa kamu sedang menghadapi
                                                                            tantangan yang cukup ekstrem tentang perasaan
                                                                            atau kondisi emosionalmu. Hal ini mungkin
                                                                            terdengar sedikit mengejutkan, tapi tenang saja,
                                                                            ini hanyalah satu langkah dalam petualangan
                                                                            hidup kita yang penuh warna dan dinamis.
                                                                            Mengapa? Karena setiap orang memiliki kisahnya
                                                                            sendiri, dan ini adalah bagian selanjutnya dalam
                                                                            kisah hidupmu. Seperti bermain video game, kamu
                                                                            berada di level yang cukup sulit, tetapi kita
                                                                            tahu bahwa dengan dukungan dan alat yang tepat,
                                                                            kamu dapat melewati tantangan ini dan mencapai
                                                                            level berikutnya. Jadi, mari tunjukkan kepada
                                                                            dunia bahwa Anda bisa menyelesaikan level ini.
                                                                            Anda juga bisa mencari bantuan dari ahli
                                                                            kesehatan mental seperti psikolog yang bisa
                                                                            membantu kamu untuk memecahkan berbagai
                                                                            rintangan yang kamu hadapi.
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>

                                                        @if ($result->status_result == 'noCounselor')
                                                            <div class="mb-3">
                                                                <a href="/konseling/paket"
                                                                    class="btn btn-primary mb-3">Konsultasikan Dengan
                                                                    Psikolog</a>
                                                            </div>
                                                        @endif

                                                        <div class="mb-3">
                                                            <a href="/test-mental" class="text-decoration-none"
                                                                data-bs-toggle="modal" data-bs-target="#AnalisisTes">Cek
                                                                Ulang Jawaban</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal Hasil Tes -->

                                        <!-- Modal Analisis Tes -->
                                        <div class="modal fade" id="AnalisisTes{{ $result->id }}" tabindex="-1"
                                            aria-labelledby="AnalisisTesLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body px-4">
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <h3 class="fw-bold">Analisis {{ $result->test->name }}
                                                                </h3>
                                                            </div>
                                                            <div class="col text-end">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div id="myCarousel{{ $result->id }}"
                                                                class="carousel slide" data-bs-interval="false">
                                                                <div class="carousel-inner mb-5" data-interval="false">
                                                                    @foreach ($test->question as $indexSoal => $item)
                                                                        <div
                                                                            class="carousel-item {{ $indexSoal == 0 ? 'active' : '' }}">
                                                                            <h5 class="fw-bold">Pertanyaan
                                                                                {{ $indexSoal + 1 }} /
                                                                                {{ $test->question->count() }}</h5>
                                                                            <b>{{ $item->question }}</b>
                                                                            <div class="my-3">
                                                                                @foreach (json_decode($item->answer) as $indexJawaban => $answer)
                                                                                    @php
                                                                                        $userAnswers = json_decode($result->answer);
                                                                                        $userAnswerIndex = $indexSoal; // Indeks jawaban user sesuai dengan urutan soal
                                                                                        $isChecked = isset($userAnswers[$userAnswerIndex]) && $userAnswers[$userAnswerIndex] == $answer->value;
                                                                                    @endphp

                                                                                    <div class="form-check">
                                                                                        <input disabled
                                                                                            class="form-check-input"
                                                                                            type="radio"
                                                                                            name="answer[{{ $indexSoal }}{{ $result->id }}]"
                                                                                            id="answer{{ $indexJawaban }}"
                                                                                            value="{{ $answer->value }}"
                                                                                            @if ($isChecked) checked @endif>
                                                                                        <label class="form-check-label"
                                                                                            for="answer{{ $indexJawaban }}">
                                                                                            {{ $answer->label }}
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                @if ($indexSoal != 0)
                                                                                    <div class="col">
                                                                                        <button class="btn btn-primary"
                                                                                            data-bs-target="#myCarousel{{ $result->id }}"
                                                                                            data-bs-slide="prev"><i
                                                                                                class="bi bi-chevron-left"></i></button>
                                                                                    </div>
                                                                                @endif
                                                                                @if ($indexSoal != $test->question->count() - 1)
                                                                                    <div class="col text-end">
                                                                                        <button class="btn btn-primary"
                                                                                            data-bs-target="#myCarousel{{ $result->id }}"
                                                                                            data-bs-slide="next"><i
                                                                                                class="bi bi-chevron-right"></i></button>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h2 class="fw-bold mb-3">Hasil Analisis</h2>
                                                        @if ($result->hasil_analisis !== null)
                                                            {{ $result->hasil_analisis }}
                                                        @else
                                                            Data belum dianalisis oleh konselor.
                                                        @endif
                                                        {{-- <p>{{ $result->hasil_analisis }}</p> --}}

                                                        <h2 class="fw-bold mb-3">Saran</h2>
                                                        @if ($result->saran !== null)
                                                            {{ $result->saran }}
                                                        @else
                                                            Data belum dianalisis oleh konselor.
                                                        @endif
                                                        {{-- <p>{{ $result->saran }}</p> --}}

                                                        @if ($result->status_result == 'noCounselor')
                                                            <p class="mt-3">Konsultasikan perkembanganmu dengan psikolog
                                                                untuk mendapat
                                                                solusi terbaik</p>

                                                            <a href="/konseling/user"
                                                                class="btn btn-primary mb-3">Konsultasikan Dengan
                                                                Psikolog</a>
                                                        @endif
                                                        <p>lakukan tes ulang setiap 2 minggu untuk dapat melihat
                                                            perkembangan kondisi kamu</p>

                                                        <a href="/test-mental" class="btn btn-outline-primary">Tes
                                                            Ulang</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal Analisis Tes -->
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (!$loop->first)
                        <script>
                            var chart{{ $test->id }} = new ApexCharts(document.querySelector("#grafik-depresi-{{ $test->id }}"), {
                                chart: {
                                    type: 'line', // Jenis grafik (misalnya line, bar, pie)
                                    height: 350, // Tinggi grafik dalam pixel
                                    // ... tambahkan opsi lain yang diperlukan
                                },
                                series: [{
                                    name: '{{ $test->name }}', // Nama seri data
                                    data: [
                                        @foreach ($test->result as $result)
                                            @if ($result->klien_id == Auth::user()->id)

                                                {{ $result->score }},
                                            @endif
                                        @endforeach
                                    ] // Nilai-nilai seri data
                                }],
                                stroke: {
                                    curve: 'smooth' // Menggunakan kurva yang halus
                                }
                                // ... tambahkan opsi grafik lainnya
                            });
                            chart{{ $test->id }}.render();
                        </script>
                    @endif
                    <script>
                        $(document).ready(function() {
                            $('#table-{{ $test->id }}').DataTable({
                                "order": [],
                            });
                        });
                    </script>
                @endforeach
            </div>
        </div>
    </div>
@endsection
