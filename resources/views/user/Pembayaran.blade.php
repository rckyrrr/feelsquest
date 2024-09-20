@extends('template.Dashboard_Template')

@section('konten')
    <div class="my-5">
        <div class="text-center">
            <h1 class="fw-bold">Pembayaran</h1>
        </div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="text-center mb-2">
            <b>Informasi Pesanan</b>
        </div>
        <div class="row">
            <div class="col mt-3 mt-lg-0">
                <div class="mb-2">
                    <p class="fw-bold">Nomor Pesanan</p>
                    INV/{{ $transaction->transactionUUID }}
                </div>
                <div class="mb-2">
                    <p class="fw-bold">Jenis Paket</p>
                    {{ $transaction->package->name }}
                </div>
                <div class="mb-2">
                    <p class="fw-bold">Tanggal Konseling</p>
                    {{ $counselingDate }}
                </div>
            </div>
            <div class="col mt-3 mt-lg-0">
                <div class="mb-2">
                    <p class="fw-bold">Tanggal Pembelian</p>
                    {{ $dateNow->format('d F Y') }}
                </div>
                <div class="mb-2">
                    <p class="fw-bold">Nama Konselor</p>
                    {{ $counseling->counselor->name }}
                </div>
                <div class="mb-2">
                    <p class="fw-bold">Jam Konseling</p>
                    {{ date('H:i', strtotime($counseling->counseling_start)) }} -
                    {{ date('H:i', strtotime($counseling->counseling_end)) }} WIB
                </div>
            </div>
        </div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="text-center">
            <b>Total Harga</b>
            <h1 class="fw-bold text-primary"></h1>
        </div>
        <div class="row">
            <b>Rincian Pembayaran</b>
            <div class="col mt-3 mt-lg-0">
                <div>Paket</div>
                @if (session('coupon'))
                    Kupon
                @endif
                <div>Total</div>
                <div>Status</div>
            </div>
            <div class="col mt-3 mt-lg-0 text-end">
                <div>{{ $transaction->package->name }}</div>
                @if (session('coupon'))
                    <div>- @rupiah(session('coupon')->discount)</div>
                    <div>@rupiah($transaction->gross_amount - session('coupon')->discount)</div>
                @else
                    <div>@rupiah($transaction->gross_amount)</div>
                @endif
                <div>{{ $transaction->payment_status }}</div>
            </div>
        </div>
    </div>

    @if ($transaction->payment_status == 'unpaid')
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="text-center">
                <b>Kupon</b>
            </div>
            <form action="/useCoupon" method="post">
                @csrf
                <div class="row">

                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="code"
                                placeholder="name@example.com">
                            <label for="floatingInput">Masukkan Kode Kupon</label>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-primary p-3 w-100" type="submit">Cek</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="/transaksi/cancel/{{ $transaction->id }}" method="post">
            @csrf
            <div class="d-grid gap-3">
                <a id="pay-button" class="btn btn-primary block">Lanjutkan Pembayaran</a>
                <button type="submit" class="btn btn-outline-danger block">Batalkan Pembayaran</button>
            </div>
        </form>
    @else
        <div class="d-grid gap-3">
            <a href="/transaksi/invoice/download/{{ $transaction->transactionUUID }}" target="_blank"
                class="btn btn-primary block">Download Invoice</a>
        </div>
    @endif

    @if ($transaction->payment_status == 'unpaid')
        @if (session('coupon'))
            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result) {


                            window.location.href =
                                "/transaksi/payment-success?transaction={{ $transaction->transactionUUID }}&coupon={{ session('coupon')->code }}"



                            console.log(result);
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                });
            </script>
        @else
            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result) {
                            window.location.href =
                                "/transaksi/payment-success?transaction={{ $transaction->transactionUUID }}"
                            console.log(result);
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                });
            </script>
        @endif
    @endif
@endsection
