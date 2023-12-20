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
      <h3 class="card-title">Daftar Pengambilan</h3>
    </div>

    <div class="card-body">
      <form action="{{ route('take.index') }}" method="get">
      <div class="input-group">
      <input type="search" name="search" class="form-control" placeholder="" value="{{ $vcari }}">
      <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
      <a href="{{ url('take') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
      </div>
      </form>
    </div>

    <div class="card-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">{{ $message }}</div>
      @endif

      @if (in_array(Auth::user()->role, ['admin','kasir']))
      <a href="{{ route('take.create') }}" class="btn btn-success">Tambah Pengambilan</a>
      <br><br>
      @endif

      @if (in_array(Auth::user()->role, ['kasir','admin']))
      <td style="text-align: center; vertical-align: middle;">
        <a href="{{ url('take/pdf') }}" class="btn btn-primary">Unduh PDF</a>
      </td>
      <br></br>
      @endif
      <table class="table table-striped table-bordered table-sm" style="font-size: 12px;">
        <tr>
          <th style="text-align: center; vertical-align: middle;">Nomor Pengambilan</th>
          <th style="text-align: center; vertical-align: middle;">Foto KTP</th>
          <th style="text-align: center; vertical-align: middle;">Nama Penyimpan</th>
          <th style="text-align: center; vertical-align: middle;">Nama Pengambil</th>
          <th style="text-align: center; vertical-align: middle;">Jumlah Simpan</th>
          <th style="text-align: center; vertical-align: middle;">Uang Ambil</th>
          <th style="text-align: center; vertical-align: middle;">Jangka Ambil</th>
          <th style="text-align: center; vertical-align: middle;">Bunga</th>
          <th style="text-align: center; vertical-align: middle;">Total Ambil</th>
          <th style="text-align: center; vertical-align: middle;">Sisa Simpan</th>
          <th style="text-align: center; vertical-align: middle;">Tanggal</th>
          <th style="text-align: center; vertical-align: middle;">Aksi</th>

        </tr>
        @if(count($takeM) > 0)
        @foreach ($takeM as $take)
        <tr>
          <td style="text-align: center; vertical-align: middle;">{{ $take->nomor_take }}</td>
          <td style="text-align: center; vertical-align: middle;">
<img src="{{ asset('storage/' . $take->foto) }}" alt="foto" style="max-width: 100px; max-height: 100px;">
  </td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->nama_penyimpan}}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->nama_pengambil }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->total_simpan }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->uang_ambil }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->lama_ambil }} Bulan</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->bunga }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->total_ambil }}</td>
          <td style="text-align: center; vertical-align: middle;">{{ $take->simpanan }}</td>

          <td style="text-align: center; vertical-align: middle;">{{ $take->created_at }}</td>

          <td style="text-align: center; vertical-align: middle; font-size: 14px;" >

    <!-- Tombol Print -->
    <a href="{{ url('take/cetak', $take->id) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-print"></i> Print
    </a>

    <!-- Tombol Edit (jika role adalah admin) -->
    @if (in_array(Auth::user()->role, ['admin']))
        <a href="{{ route('take.edit', $take->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>

        <!-- Form Hapus (jika role adalah admin) -->
        <form action="{{ route('take.destroy', $take->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Pembayaran !?')">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </form>
    @endif

</td>


        </tr>
        @endforeach
        @else
        <tr>
          <td colspan="12">Pengambilan Tidak Ditemukan</td>
        </tr>
        @endif
      </table>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection