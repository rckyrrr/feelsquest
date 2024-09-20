@extends('template.Dashboard_Template')

@section('konten')
    <div class="container-fluid px-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item me-3" role="presentation">
                <button class="btn btn-outline-primary active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">Semua</button>
            </li>
            <li class="nav-item me-3" role="presentation">
                <button class="btn btn-outline-primary" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Menunggu Konfirmasi</button>
            </li>
            <li class="nav-item me-3" role="presentation">
                <button class="btn btn-outline-primary" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Dibatalkan</button>
            </li>
            <li class="nav-item me-3" role="presentation">
                <button class="btn btn-outline-primary" id="pills-selesai-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-selesai" type="button" role="tab" aria-controls="pills-selesai"
                    aria-selected="false" selesai>Selesai</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">

                <div class="shadow p-4 mb-5 bg-white rounded">

                    <table id="table-transaksi-all" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ date('d F Y', strtotime($transaction->created_at)) }}</td>
                                    <td>{{ Auth::user()->name }}</td>
                                    @if ($transaction->payment_status == 'paid')
                                        <td><a class="btn btn-primary">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>
                                        <td>
                                            <a href="/transaksi/payment?transaction={{ $transaction->transactionUUID }}"
                                                class="text-decoration-none">View</a> |
                                            <a href="/transaksi/invoice/download/{{ $transaction->transactionUUID }}"
                                                target="_blank" class="text-decoration-none me-4">Download</a>
                                        </td>
                                    @elseif($transaction->payment_status == 'unpaid')
                                        <td><a class="btn btn-warning"
                                                style="color:white;">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>
                                        <td><a href="/transaksi/payment?transaction={{ $transaction->transactionUUID }}"
                                                class="text-decoration-none">Lanjutkan Pembayaran</a></td>
                                    @elseif($transaction->payment_status == 'cancelled')
                                        <td><a class="btn btn-danger"
                                                style="color:white;">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>
                                        <td>&nbsp;</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="shadow p-4 mb-5 bg-white rounded">

                    <table id="table-transaksi-pending" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Due Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                @if ($transaction->payment_status == 'unpaid')
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($transaction->created_at)) }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td><a class="btn btn-warning"
                                                style="color:white;">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>
                                        <td><a href="/transaksi/payment?transaction={{ $transaction->transactionUUID }}"
                                                class="text-decoration-none">Lanjutkan Pembayaran</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">

                <div class="shadow p-4 mb-5 bg-white rounded">

                    <table id="table-transaksi-batal" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Due Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                @if ($transaction->payment_status == 'cancelled')
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($transaction->created_at)) }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td><a class="btn btn-danger">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>

                                        <td>&nbsp;</td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="tab-pane fade" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab"
                tabindex="0">

                <div class="shadow p-4 mb-5 bg-white rounded">

                    <table id="table-transaksi-selesai" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Due Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                @if ($transaction->payment_status == 'paid')
                                    <tr>
                                        <td>{{ date('d F Y', strtotime($transaction->created_at)) }}</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td><a class="btn btn-primary">{{ strtoupper($transaction->payment_status) }}</a>
                                        </td>
                                        <td>
                                            <a href="/transaksi/payment?transaction={{ $transaction->transactionUUID }}"
                                                class="text-decoration-none">View</a> |
                                            <a href="/transaksi/invoice/download/{{ $transaction->transactionUUID }}"
                                                target="_blank" class="text-decoration-none me-4">Download</a>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
