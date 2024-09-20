<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        .text-center {
            text-align: center;
        }

        .gambar {
            width: 150px;
            height: 50px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            border: 0.1px solid grey;
            padding: 5px;
            border-radius: 5px
        }

        table {
            width: 100%;
        }

        hr {
            width: 100%;
        }

        .end {
            text-align: right;
        }
    </style>
</head>

<body>
    <img class="gambar"
        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('src/logo/Logo.png'))) }}">
    <h1 class="text-center">Invoice</h1>
    <p>Invoice ID : {{ $transaction->transactionUUID }}</p>
    <p>Username : {{ $transaction->klien->name }}</p>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <td>Nama Paket</td>
                    <td>Jumlah Sesi</td>
                    <td>Deskripsi</td>
                    <td>Tanggal</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->package->name }}</td>
                    <td>{{ $transaction->package->total_sessions }}</td>
                    <td>{{ $transaction->package->description }}</td>
                    <td>{{ Carbon\Carbon::parse($transaction->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="end">
        <p>Total : @rupiah($transaction->gross_amount)</p>
    </div>

    <p>Notes</p>
    <p>*Harga Termasuk PPN</p>
</body>

</html>
