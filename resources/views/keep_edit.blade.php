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
      <h3 class="card-title">Edit Data Pinjaman</h3>

    </div>
    <div class="card-body">
      <a href="{{ route('keep.index') }}" class="btn btn-secondary">Kembali</a>
      <br><br>

      <form action="{{ route('keep.update', $keep->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
    <label for="">Nomor Simpanan</label>
    <input name="nomor_keep" type="number" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
    @error('nomor_keep')
    <p>{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    <label for="">Nama Penyimpan</label>
    <input name="nama_penyimpan" type="text" class="form-control" placeholder="...">
    @error('nama_penyimpan')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Jumlah Simpan</label>
    <input name="jumlah_simpan" type="number" class="form-control" placeholder="...">
    @error('jumlah_simpan')
    <p>{{ $message }}</p>
    @enderror
</div>

        <input type="submit" name="submit" class="btn btn-primary" value="Ubah">

      </form>
    </div>
    <!-- /.card-body -->

  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@endsection