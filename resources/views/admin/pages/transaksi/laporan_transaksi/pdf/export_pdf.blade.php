<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header,
        .footer {
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>{{ $title }}</h2>
        <p>Tanggal: {{ $date }}</p>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Tanggal Order</th>
                    <th>Nama User</th>
                    <th>Username Kasir</th>
                    <th>Nama Mitra</th>
                    <th>Total Harga</th>
                    <th>Status Order</th>
                    <th>Tipe Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $data)
                    <tr>
                        <td>{{ $data->invoiceId }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->tanggalOrder)->translatedFormat('d F Y') }}</td>
                        <td>{{ $data->namaUser }}</td>
                        <td>{{ $data->usernameKasir }}</td>
                        <td>{{ $data->namaMitra }}</td>
                        <td>{{ 'Rp ' . number_format($data->totalHarga, 0, ',', '.') }}</td>
                        <td>{{ $data->statusOrder == 'PAID' ? 'Sudah Bayar' : 'Belum Bayar' }}</td>
                        <td>{{ $data->tipeTransaksi == 'CASH' ? 'Cash' : ($data->tipeTransaksi == 'TRANSFER' ? 'Online Payment' : 'Belum Bayar') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
