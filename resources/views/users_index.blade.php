@extends('adminsb')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div>
      <div class="card-header">
        <h3 class="card-title">Daftar Pengguna</h3>
        </div>
   
      </div>
      <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        <a href="{{ route('users.create') }}" class="btn btn-success">Tambah Data</a>
        <br><br>
       <table class="table table-striped table-bordered">
<tr>
  <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
  <th style="text-align: center; vertical-align: middle;">Username</th>
  <th style="text-align: center; vertical-align: middle;">Role</th>
  <th style="text-align: center; vertical-align: middle;">Aksi</th>
</tr>
@if(count($UsersM) > 0)
@foreach ($UsersM as $users)
<tr>
  <td style="text-align: center; vertical-align: middle;">{{ $users->name}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $users->username}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $users->role}}</td>
  <td style="text-align: center; vertical-align: middle;">
  <a href="{{ route('users.edit', $users->id) }}" class="btn btn-warning" style="margin-right: 5px;">
    <i class="fas fa-edit"></i> Edit
</a>

<form action="{{ route('users.destroy', $users->id) }}" method="POST" style="display: inline-block; margin-right: 5px;">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data !?')">
        <i class="fas fa-trash-alt"></i> Hapus
    </button>
</form>

<a href="{{ route('users.changepassword', $users->id)}}" class="btn btn-success">
    <i class="fas fa-key"></i> Ganti Kata Sandi
</a>
</td>
</tr>
@endforeach
@else
<tr>
  <td colspan="4">Data Tidak Ditemukan</td> 
</tr>
@endif
       </table>

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection