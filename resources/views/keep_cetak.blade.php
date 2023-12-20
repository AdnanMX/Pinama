<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Courier New", monospace;
            text-align: left; /* Mengatur konten ke tengah */
        }

        h1 {
            text-align: center;
        }

        .invoice {
            width: 50%; /* Lebar invoice */
            margin: 0 auto; /* Mengatur posisi ke tengah */
            border: 2px solid #000; /* Garis border untuk invoice */
            padding: 20px; /* Ruang dalam di sekitar invoice */
        }

        .invoice-item {
            margin-bottom: 20px;
            text-align: left; /* Konten item invoice rata kiri */
        }

        .item-label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    @foreach($keepM as $data)
    <div class="invoice">
    <h2 style="text-align: center;">Struk Penyimpanan</h2>
    <div class="invoice-item">
        <span class="item-label">Nomor Penyimpan:</span> {{ $data->nomor_keep }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Nama Penyimpan:</span> {{ $data->nama_penyimpan }}
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Jumlah Simpan:</span> {{ $data->jumlah_simpan }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Pajak:</span> {{ $data->pajak }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Total Simpan:</span> {{ $data->total_simpan }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Sisa Simpan:</span> {{ $data->sisa_simpan }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Tanggal:</span> {{ $data->created_at }}
    </div>
<hr>
    
</div>
    @endforeach
</body>
</html>