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
      <a href="{{ route('payment.index') }}" class="btn btn-secondary">Kembali</a>
      <br><br>

      <form action="{{ route('payment.update', $payment->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
                    <label for="">Nomor Pembayaran</label>
                    <input name="nomor_payment" type="text" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
                    @error('nomor_payment')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                <label for="">Nama Peminjam + Pinjaman + Status</label>
                <select name="id_payment" class="form-control" required>
                    <option value="">Pilih Pinjaman</option>
                    @foreach ($borrowM as $data)
                    <option value="{{ $data->id }}">
                        {{ $data->nama_peminjam }} - {{$data->total_pinjam}} - {{$data->status}}
                    </option>
                    @endforeach
                </select>
                @error('id_payment')
                <p>{{ $message }}</p>
                @enderror
            </div>

                <div class="form-group">
                    <label for="">Uang Bayar</label>
                    <input name="uang_bayar" type="number" class="form-control" placeholder="...">
                    @error('uang_bayar')
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