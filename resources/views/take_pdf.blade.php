<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi Pengambilan</title>
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
    <h1>Daftar Pengambilan</h1>
    <table>
        <tr>
            <th>Nomor Pengambilan</th>
            <th>Nama Penyimpan</th>
            <th>Nama Pengambil</th>
            <th>Jumlah Simpan</th>
            <th>Uang Ambil</th>
            <th>Jangka Ambil</th>
            <th>Bunga</th>
            <th>Total Ambil</th>
            <th>Sisa Simpan</th>
            <th>Tanggal</th>
        </tr>
        @if(count($takeM) > 0)
            @foreach ($takeM as $take)
                <tr>
                    <td>{{ $take->nomor_take }}</td>
                    <td>{{ $take->nama_penyimpan}}</td>
                    <td>{{ $take->nama_pengambil }}</td>
                    <td>{{ $take->total_simpan }}</td>
                    <td>{{ $take->uang_ambil }}</td>
                    <td>{{ $take->lama_ambil }} Bulan</td>
                    <td>{{ $take->bunga }}</td>
                    <td>{{ $take->total_ambil }}</td>
                    <td>{{ $take->simpanan }}</td>
                    <td>{{ $take->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">Pengambilan Tidak Ditemukan</td>
            </tr>
        @endif
    </table>
</body>
</html>
