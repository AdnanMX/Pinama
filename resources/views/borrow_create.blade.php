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
        <h3 class="card-title">Tambah Data Pinjaman</h3>

      </div>
      <div class="card-body">
        <a href="{{ route('borrow.index') }}" 
        class="btn btn-secondary">Kembali</a>
        <br><br>
        
        <form action="{{ route('borrow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
    <label for="">Nomor Peminjaman</label>
    <input name="nomor_borrow" type="number" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
    @error('nomor_borrow')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Foto KTP</label>
    <div class="file">
        <input type="file" class="form" id="fotoKTP" name="foto">
    </div>
    @error('foto')
        <p>{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    <label for="">Nama Peminjam</label>
    <input name="nama_peminjam" type="text" class="form-control" placeholder="...">
    @error('nama_peminjam')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Alamat</label>
    <input name="alamat" type="text" class="form-control" placeholder="...">
    @error('alamat')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">No HP</label>
    <input name="no_hp" type="number" class="form-control" placeholder="...">
    @error('no_hp')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Jumlah Pinjam</label>
    <input name="jumlah_pinjam" type="number" class="form-control" placeholder="...">
    @error('jumlah_pinjam')
    <p>{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="">Lama Pinjam (Bulan)</label>
    <input name="lama_pinjam" type="number" class="form-control" placeholder="..." value="1">
    @error('lama_pinjam')
    <p>{{ $message }}</p>
    @enderror
</div>
    <input type="submit" name="submit" class="btn btn-primary" value="Tambah">

        </form>
      </div>
      <!-- /.card-body -->
      
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection