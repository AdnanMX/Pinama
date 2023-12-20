<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi Penyimpanan</title>
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

        td[colspan="7"] {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <h1>Daftar Simpan</h1>
    <table>
        <tr>
            <th>Nomor Simpan</th>
            <th>Nama Penyimpan</th>
            <th>Jumlah Simpan</th>
            <th>Pajak</th>
            <th>Total Simpan</th>
            <th>Sisa Simpan</th>
            <th>Tanggal</th>
        </tr>
        @if(count($keepM) > 0)
            @foreach ($keepM as $keep)
                <tr>
                    <td>{{ $keep->nomor_keep }}</td>
                    <td>{{ $keep->nama_penyimpan }}</td>
                    <td>{{ $keep->jumlah_simpan }}</td>
                    <td>{{ $keep->pajak }}</td>
                    <td>{{ $keep->total_simpan }}</td>
                    <td>{{ $keep->sisa_simpan }}</td>
                    <td>{{ $keep->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">Simpanan Tidak Ditemukan</td>
            </tr>
        @endif
    </table>
</body>
</html>
