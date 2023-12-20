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
        <h3 class="card-title">Daftar Data Simpan</h3>
      </div>

      <div class="card-body">
      <form action="{{ route('keep.index') }}" method="get">
      <div class="input-group">
      <input type="search" name="search" class="form-control" placeholder="" value="{{ $vcari }}">
      <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
      <a href="{{ url('keep') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
      </div>
      </form>
      </div>

      <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif

        @if (in_array(Auth::user()->role, ['admin','kasir']))
        <a href="{{ route('keep.create') }}" class="btn btn-success">Tambah Simpanan</a>
        <br><br>
        @endif

        @if (in_array(Auth::user()->role, ['kasir','admin']))
<td style="text-align: center; vertical-align: middle;">
  <a href="{{ url('keep/pdf') }}" class="btn btn-primary">Unduh PDF</a>
</td>
<br></br>
@endif

       <table class="table table-striped table-bordered table-sm">
<tr>
  <th style="text-align: center; vertical-align: middle;">Nomor Simpan</th>
  <th style="text-align: center; vertical-align: middle;">Nama Penyimpan</th>
  <th style="text-align: center; vertical-align: middle;">Jumlah Simpan</th>
  <th style="text-align: center; vertical-align: middle;">Pajak</th>
  <th style="text-align: center; vertical-align: middle;">Total Simpan</th>
  <th style="text-align: center; vertical-align: middle;">Sisa Simpan</th>
  <th style="text-align: center; vertical-align: middle;">Tanggal</th>
  <th style="text-align: center; vertical-align: middle;">Aksi</th>


</tr>
@if(count($keepM) > 0)
@foreach ($keepM as $keep)
<tr>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->nomor_keep }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->nama_penyimpan }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->jumlah_simpan }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->pajak }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->total_simpan }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->sisa_simpan }}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $keep->created_at }}</td>

        <td style="text-align: center; vertical-align: middle;">
    <a href="{{ url('keep/cetak', $keep->id) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-print"></i> Print
    </a>
    @if (in_array(Auth::user()->role, ['admin']))
        <a href="{{ route('keep.edit', $keep->id) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('keep.destroy', $keep->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Konfirmasi Hapus Simpanan !?')">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </form>
    @endif
</td>

</tr>
@endforeach
@else
<tr>
  <td colspan="8">Simpanan Tidak Ditemukan</td> 
</tr>
@endif
       </table>
      </div>
      </div>
  </section>
  <!-- /.content -->
@endsection