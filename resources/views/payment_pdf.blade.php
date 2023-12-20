<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi Pembayaran</title>
    <style>
        body {
            font-size: 14px; 
        }

        h1, th, td {
            font-size: 12px; 
        }

        table {
            width: 100%;
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        td[colspan="8"] {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <h1>Daftar Pembayaran</h1>
    <table>
        <tr>
            <th>Nomor Pembayaran</th>
            <th>Nama Peminjam</th>
            <th>Total Pinjam</th>
            <th>Uang Bayar</th>
            <th>Sisa Bayar</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        @if(count($paymentM) > 0)
            @foreach ($paymentM as $payment)
                <tr>
                    <td>{{ $payment->nomor_payment }}</td>
                    <td>{{ $payment->nama_peminjam }}</td>
                    <td>{{ $payment->total_pinjam }}</td>
                    <td>{{ $payment->uang_bayar }}</td>
                    <td>{{ $payment->bayaran }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">Pembayaran Tidak Ditemukan</td>
            </tr>
        @endif
    </table>
</body>
</html>
