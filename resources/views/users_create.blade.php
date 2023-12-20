@extends('adminsb')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h3>Tambah Data Pengguna</h3>
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

            <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input name="name" type="text" class="form-control" placeholder="...">
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" class="form-control" placeholder="...">
                @error('username')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="...">
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Ulangi Password</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="...">
                @error('password_confirm')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option>Pilih Role</option>
                    <option value="kasir">Kasir</option>
                    <!-- <option value="owner">Owner</option> -->
                    <option value="admin">Admin</option>
                </select>
                @error('role')
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