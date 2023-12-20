<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirech;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;

class UsersR extends Controller
{

    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman User'
        ]);
        $subtitle = "Daftar Pengguna";
        $UsersM = User::all();
        return view('users_index', compact('subtitle', 'UsersM'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah User'
        ]);
        $subtitle = "Tambah Produk";
        return view('users_create', compact('subtitle'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah User'
        ]);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required'
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $user->save();

        return redirect()->route('users.store')->with('success', 'Pengguna Berhasil Ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit User'
        ]);
        $subtitle = "Edit Data Pengguna";
        $data = User::find($id);
        return view('users_edit', compact('subtitle', 'data'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit User'
        ]);
        $request->validate([
            'name' => 'required',
            // 'username' => 'required',
            'role' => 'required'
        ]);
   
        $data = request()->except(['_token', '_method', 'submit']);
   
        User::where('id', $id)->update($data);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus User'
        ]);
        User::where('id', $id)->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
    }

    public function changepassword($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Ganti Kata Sandi User'
        ]);
        $subtitle = "Edit Kata Sandi Pengguna";
        $data = User::find($id);
        return view('users_changepassword', compact('subtitle', 'data'));
    }

    public function change(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Ganti Kata Sandi User'
        ]);
        $request->validate([
            'password_new' => 'required',
            'password_confirm' => 'required|same:password_new',
        ]);
        $users = User::where("id", $id)->first();
        $users->update([
            'password' => Hash::make($request->password_new),
        ]);
        return redirect()->route('users.index')->with('success', 'Kata Sandi Pengguna Berhasil Diperbaharui');
    }
}
