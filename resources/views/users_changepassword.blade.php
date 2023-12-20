@extends('adminsb')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Ubah Kata Sandi Pengguna</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengguna</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
  
    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-body">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            <br><br>

            <form action="{{ route('users.change', $data->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" class="form-control" value="{{ $data->username }}" readonly>
                @error('username')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <!-- <div class="form-group">
                <label>Kata Sandi Lama</label>
                <input name="password_old" type="password" class="form-control" placeholder="...">
                @error('password_old')
                    <p>{{ $message }}</p>
                @enderror
            </div> -->

            <div class="form-group">
                <label>Kata Sandi Baru</label>
                <input name="password_new" type="password" class="form-control" placeholder="...">
                @error('password_new')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Ulangi Kata Sandi Baru</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="...">
                @error('password_confirm')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>

        </div>
    </div>
    <!-- /.card -->
  
</section>
<!-- /.content -->
@endsection