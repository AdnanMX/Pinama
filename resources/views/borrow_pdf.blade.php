<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi Peminjaman</title>
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

        td[colspan="10"] {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <h1>Daftar Pinjaman</h1>
    <table>
        <tr>
            <th>Nomor Peminjaman</th>
            <th>Nama Peminjam</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Jumlah Pinjam</th>
            <th>Lama Pinjam</th>
            <th>Bunga</th>
            <th>Total Pinjam</th>
            <th>Sisa Bayar</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        @if(count($borrowM) > 0)
            @foreach ($borrowM as $borrow)
                <tr>
                    <td>{{ $borrow->nomor_borrow }}</td>
                    <td>{{ $borrow->nama_peminjam }}</td>
                    <td>{{ $borrow->alamat }}</td>
                    <td>{{ $borrow->no_hp }}</td>
                    <td>{{ $borrow->jumlah_pinjam }}</td>
                    <td>{{ $borrow->lama_pinjam }} Bulan</td>
                    <td>{{ $borrow->bunga }}</td>
                    <td>{{ $borrow->total_pinjam }}</td>
                    <td>{{ $borrow->sisa_bayar }}</td>
                    <td>{{ $borrow->status }}</td>
                    <td>{{ $borrow->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">Pinjaman Tidak Ditemukan</td>
            </tr>
        @endif
    </table>
</body>
</html>
