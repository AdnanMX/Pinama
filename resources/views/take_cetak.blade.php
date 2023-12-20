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

    @foreach($takeM as $data)
    <div class="invoice">
    <h2 style="text-align: center;">Struk Pengambilan</h2>
    <div class="invoice-item">
        <span class="item-label">Nomor Pengambilan:</span> {{ $data->nomor_take }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Nama Penyimpan:</span> {{ $data->nama_penyimpan }}
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Nama Pengambil:</span> {{ $data->nama_pengambil }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Jumlah Simpan:</span> {{ $data->total_simpan }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Uang Ambil:</span> {{ $data->uang_ambil }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Jangka Ambil:</span> {{ $data->lama_ambil }} Bulan
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Bunga:</span> {{ $data->bunga }}
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Total Ambil:</span>  {{ $data->total_ambil }}
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Sisa Simpan:</span> {{ $data->simpanan }}
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