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
        <h3 class="card-title">Tambah Data Pengambilan</h3>

      </div>
      <div class="card-body">
        <a href="{{ route('take.index') }}" 
        class="btn btn-secondary">Kembali</a>
        <br><br>
        
        <form action="{{ route('take.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <label for="">Nomor Pengambilan</label>
            <input name="nomor_take" type="text" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
            @error('nomor_take')
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
                    <label for="">Nama Pengambil</label>
                    <input name="nama_pengambil" type="text" class="form-control" placeholder="...">
                    @error('nama_pengambil')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                <label for="">Nama Penyimpan + Simpanan + Tanggal</label>
                <select name="id_take" class="form-control" required>
                    <option value="">Pilih</option>
                    @foreach ($keepM as $data)
                    <option value="{{ $data->id }}">
                        {{ $data->nama_penyimpan }} - {{$data->sisa_simpan}} - {{$data->created_at}}
                    </option>
                    @endforeach
                </select>
                @error('id_take')
                <p>{{ $message }}</p>
                @enderror
            </div>

                <div class="form-group">
                    <label for="">Uang Ambil</label>
                    <input name="uang_ambil" type="number" class="form-control" placeholder="...">
                    @error('uang_ambil')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
    <label for="">Jangka Ambil (Bulan)</label>
    <input name="lama_ambil" type="number" class="form-control" placeholder="..." value="1">
    @error('lama_ambil')
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