@extends('adminsb')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div>
    <div class="card-header">
      <h3 class="card-title">Daftar Pembayaran</h3>
    </div>

    <div class="card-body">
      <form action="{{ route('payment.index') }}" method="get">
      <div class="input-group">
      <input type="search" name="search" class="form-control" placeholder="" value="{{ $vcari }}">
      <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
      <a href="{{ url('payment') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
      </div>
      </form>
    </div>

    <div class="card-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">{{ $message }}</div>
      @endif

      @if (in_array(Auth::user()->role, ['admin','kasir']))
      <a href="{{ route('payment.create') }}" class="btn btn-success">Tambah Pembayaran</a>
      <br><br>
      @endif

      @if (in_array(Auth::user()->role, ['kasir','admin']))
      <td style="text-align: center; vertical-align: middle;">
        <a href="{{ url('payment/pdf') }}" class="btn btn-primary">Unduh PDF</a>
      </td>
      <br></br>
      @endif
      <table class="table table-striped table-bordered">
        <tr>
          <th style="text-align: center; vertical-align: middle;">Nomor Pembayaran</th>
          <th style="text-align: center; vertical-align: middle;">Nama Peminjam</th>
          <th style="text-align: center; vertical-align: middle;">Total Pinjam</th>
          <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
          <th style="text-align: center; vertical-align: middle;">Sisa Bayar</th>
          <th style="text-align: center; vertical-align: middle;">Status</th>
          <th style="text-align: center; vertical-align: middle;">Tanggal</th>
          <th style="text-align: center; vertical-align: middle;">Aksi</th>

        </tr>
        @if(count($paymentM) > 0)
        @foreach ($paymentM as $payment)
        <tr>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->nomor_payment }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->nama_peminjam }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->total_pinjam }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->uang_bayar }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->bayaran }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->status }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $payment->created_at }}</td>

          <td style="text-align: center; vertical-align: middle;">

    <!-- Tombol Print -->
    <a href="{{ url('payment/cetak', $payment->id) }}" class="btn btn-primary">
        <i class="fas fa-print"></i> Print
    </a>

    <!-- Tombol Edit (jika role adalah admin) -->
    @if (in_array(Auth::user()->role, ['admin']))
        <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>

        <!-- Form Hapus (jika role adalah admin) -->
        <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Pembayaran !?')">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </form>
    @endif

</td>


        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="9">Pembayaran Tidak Ditemukan</td>
        </tr>
        @endif
      </table>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection