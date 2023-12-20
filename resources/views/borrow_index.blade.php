@extends('adminsb')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2"> 
        
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div>
      <div class="card-header">
        <h3 class="card-title">Daftar Pinjaman</h3>
      </div>

      <div class="card-body">
      <form action="{{ route('borrow.index') }}" method="get">
      <div class="input-group">
      <input type="search" name="search" class="form-control" placeholder="" value="{{ $vcari }}">
      <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
      <a href="{{ url('borrow') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
      </div>
      </form>
      </div>

      <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif

        @if (in_array(Auth::user()->role, ['admin','kasir']))
        <a href="{{ route('borrow.create') }}" class="btn btn-success">Tambah Pinjaman</a>
        <br><br>
        @endif

        @if (in_array(Auth::user()->role, ['kasir','admin']))
<td style="text-align: center; vertical-align: middle;">
  <a href="{{ url('borrow/pdf') }}" class="btn btn-primary">Unduh PDF</a>
</td>
<br></br>
@endif

       <table class="table table-striped table-bordered table-sm" style="font-size: 12px;">
<tr>

  <th style="text-align: center; vertical-align: middle;">Nomor Peminjaman</th>
  <th style="text-align: center; vertical-align: middle;">Foto KTP</th>
  <th style="text-align: center; vertical-align: middle;">Nama Peminjam</th>
  <th style="text-align: center; vertical-align: middle;">Alamat</th>
  <th style="text-align: center; vertical-align: middle;">No HP</th>
  <th style="text-align: center; vertical-align: middle;">Jumlah Pinjam</th>
  <th style="text-align: center; vertical-align: middle;">Lama Pinjam</th>
  <th style="text-align: center; vertical-align: middle;">Bunga</th>
  <th style="text-align: center; vertical-align: middle;">Total Pinjam</th>
  <th style="text-align: center; vertical-align: middle;">Sisa Bayar</th>
  <th style="text-align: center; vertical-align: middle;">Status</th>
  <th style="text-align: center; vertical-align: middle;">Tanggal</th>
  <th style="text-align: center; vertical-align: middle;">Aksi</th>


</tr>
@if(count($borrowM) > 0)
@foreach ($borrowM as $borrow)
<tr>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->nomor_borrow }}</td>
  <td style="text-align: center; vertical-align: middle;">
      <img src="{{ asset('storage/' . $borrow->foto) }}" alt="foto" style="max-width: 100px; max-height: 100px;">
  </td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->nama_peminjam }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->alamat }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->no_hp }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->jumlah_pinjam }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->lama_pinjam }} Bulan</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->bunga }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->total_pinjam }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->sisa_bayar }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->status }}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $borrow->created_at }}</td>
  <td style="text-align: center; vertical-align: middle; font-size: 14px;">
    <a href="{{ url('borrow/cetak', $borrow->id) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-print"></i> Print
    </a>
    @if (in_array(Auth::user()->role, ['admin']))
        <a href="{{ route('borrow.edit', $borrow->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Transaksi !?')">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    @endif
</td>

</tr>
@endforeach
@else
<tr>
  <td colspan="13">Peminjaman Tidak Ditemukan</td> 
</tr>
@endif
       </table>
      </div>
      </div>
  </section>
  <!-- /.content -->
@endsection