<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feelsbox</title>

    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



    <!-- Link Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Link Style.CSS -->
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">

    {{-- <link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css"> --}}

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="text-center mt-3">
                    <a href="/"><img src="{{ asset('src/logo/Logo and Text/Logo and Text Default.png') }}"
                            alt="" width="150"></a>
                </div>
                <div class="pt-5 text-center pb-3">
                    @if (Auth::user()->foto != null)
                        <img src="{{ asset('image_uploaded/image_user/' . auth()->user()->foto) }}"
                            class="profile-img-side">
                    @else
                        <i class="bi bi-person-circle text-primary display-1" id="icon"></i>
                    @endif
                    <h3>{{ auth()->user()->name }}</h3>
                </div>

                <a class="btn @if (Request::is('dashboard*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif py-3 w-100"
                    href="/dashboard/{{ auth()->user()->user_type }}"><i class="bi bi-house-fill"></i>
                    Dashboard</a>

                @if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'superadmin')
                    <a class="btn py-3 @if (Request::is('data-user*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/data-user"><i class="bi bi-person-fill"></i>
                        User</a>
                    <a class="btn py-3 @if (Request::is('data-website*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/data-website"><i class="bi bi-globe"></i>
                        Data Website</a>
                    <a class="btn py-3 @if (Request::is('data-keuangan*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/data-keuangan"><i class="bi bi-bank2"></i>
                        Keuangan</a>
                @elseif (auth()->user()->user_type == 'konselor')
                    <a class="btn py-3 @if (Request::is('konseling*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/konseling/{{ auth()->user()->user_type }}"><i class="bi bi-chat-fill"></i>
                        Konseling</a>
                    <a class="btn py-3 @if (Request::is('tes-mental*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/tes-mental/{{ auth()->user()->user_type }}"><i class="bi bi-clipboard-fill"></i> Tes
                        Mental</a>
                    <a class="btn py-3 @if (Request::is('keuangan*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/keuangan/{{ auth()->user()->user_type }}"><i class="bi bi-bank2"></i> Keuangan</a>
                    <a class="btn py-3 @if (Request::is('profile*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/profile/{{ auth()->user()->user_type }}"><i class="bi bi-gear-fill"></i> Edit
                        Profile</a>
                @else
                    <a class="btn py-3 @if (Request::is('konseling*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/konseling/{{ auth()->user()->user_type }}"><i class="bi bi-chat-fill"></i>
                        Konseling</a>
                    <a class="btn py-3 @if (Request::is('tes-mental*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/tes-mental/{{ auth()->user()->user_type }}"><i class="bi bi-clipboard-fill"></i> Tes
                        Mental</a>
                    <a class="btn py-3 @if (Request::is('transaksi*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/transaksi/{{ auth()->user()->user_type }}"><i class="bi bi-bank2"></i> Transaksi</a>
                    <a class="btn py-3 @if (Request::is('profile*')) btn-primary mb-1 @else btn-outline-primary border-0 mb-1 @endif w-100"
                        href="/profile/{{ auth()->user()->user_type }}"><i class="bi bi-gear-fill"></i> Edit
                        Profile</a>
                @endif


                <a class="btn py-3 btn-outline-primary border-0 mb-1 w-100" href="/logout"><i
                        class="bi bi-box-arrow-right"></i>
                    Logout</a>
            </div>
            <div class="col py-5 min-vh-100 bg-light">

                @yield('konten')

            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="text-center text-lg-start bg-primary text-white">

        <!-- Copyright -->
        <div class="text-center p-4 ">
            Copyright © 2023 Feelsbox All Rights Reserved
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>


    <script>
        new Chart(document.getElementById("chart-tes"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: "transparent",
                    borderColor: window.theme.primary,
                    data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Halaman Dasboard Konselor -->
    <script>
        new Chart(document.getElementById("konsultasi-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });


        new Chart(document.getElementById("pemasukan-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });

        new Chart(document.getElementById("tes-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    </script>


    <!-- Halaman Dasboard Admin -->
    <script>
        new Chart(document.getElementById("gender-pie"), {
            type: "pie",
            data: {
                labels: ["Social", "Search Engines", "Direct", "Other"],
                datasets: [{
                    data: [260, 125, 54, 146],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.success,
                        window.theme.warning,
                        "#dee2e6"
                    ],
                    borderColor: "transparent"
                }]
            },
            options: {
                maintainAspectRatio: false,
            }
        });

        new Chart(document.getElementById("profit-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    </script>

    <!-- Keuangan -->
    <script>
        new Chart(document.getElementById("gross-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    </script>


    <!-- Data Gaji -->
    <script>
        new Chart(document.getElementById("gaji-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });

        new Chart(document.getElementById("konselor-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Last year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }, {
                    label: "This year",
                    backgroundColor: "#dee2e6",
                    borderColor: "#dee2e6",
                    hoverBackgroundColor: "#dee2e6",
                    hoverBorderColor: "#dee2e6",
                    data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table-depresi').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-kecemasan').DataTable({
                "order": [],
            });
        });
        $(document).ready(function() {
            $('#table-mental').DataTable({
                "order": [],
            });
        });
        $(document).ready(function() {
            $('#table-konseling-ongoing').DataTable({
                "order": [],
            });
        });
        $(document).ready(function() {
            $('#table-konseling-completed').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-transaksi-all').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-transaksi-pending').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-transaksi-batal').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-transaksi-selesai').DataTable({
                "order": [],
            });
        });

        $(document).ready(function() {
            $('#table-konselor-jadwal').DataTable({
                "order": [],
            });
        });
    </script>
</body>

</html>
