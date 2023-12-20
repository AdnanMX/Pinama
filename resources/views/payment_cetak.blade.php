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

    @foreach($paymentM as $data)
    <div class="invoice">
    <h2 style="text-align: center;">Struk Pembayaran</h2>
    <div class="invoice-item">
        <span class="item-label">Nomor Pembayaran:</span> {{ $data->nomor_payment }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Nama Peminjam:</span> {{ $data->nama_peminjam }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Total Pinjam:</span> {{ $data->total_pinjam }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Uang Bayar:</span> {{ $data->uang_bayar }}
    </div>
<hr>
    <div class="invoice-item">
        <span class="item-label">Sisa Bayar:</span> {{ $data->bayaran }}
    </div>
<hr>
<div class="invoice-item">
        <span class="item-label">Status:</span> {{ $data->status }}
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