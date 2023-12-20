<?php

namespace App\Http\Controllers;
use App\Models\BorrowM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BorrowC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Pinjaman'
        ]);
        $subtitle = "Daftar Pembayaran";
        $vcari = request('search');
        $borrowM = BorrowM::select('borrow.*', 'borrow.id AS id')->where('borrow.created_at', 'like', "%$vcari%")->orWhere('borrow.nama_peminjam', 'like', "%$vcari%")->orWhere('borrow.nomor_borrow', 'like', "%$vcari%")
        ->orWhere('borrow.jumlah_pinjam', 'like', "%$vcari%")
        ->orWhere('borrow.bunga', 'like', "%$vcari%")
        ->orWhere('borrow.lama_pinjam', 'like', "%$vcari%")
        ->orWhere('borrow.total_pinjam', 'like', "%$vcari%")
        ->orWhere('borrow.sisa_bayar', 'like', "%$vcari%")
        ->orWhere('borrow.alamat', 'like', "%$vcari%")
        ->orWhere('borrow.no_hp', 'like', "%$vcari%")
        ->orWhere('borrow.status', 'like', "%$vcari%")->paginate(10);
        return view('borrow_index', compact('subtitle', 'borrowM','vcari'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Pinjaman'
        ]);
        $subtitle = "Tambah Pembayaran";
        return view('borrow_create', compact('subtitle'));
    }

    public function store(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Proses Tambah Pinjaman'
    ]);

    $request->validate([
        'nomor_borrow' => 'required',
        'nama_peminjam' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'jumlah_pinjam' => 'required|numeric|min:0',
        'lama_pinjam' => 'required',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $borrow = new BorrowM;
    $borrow->nomor_borrow = $request->input('nomor_borrow');
    $borrow->nama_peminjam = $request->input('nama_peminjam');
    $borrow->alamat = $request->input('alamat');
    $borrow->no_hp = $request->input('no_hp');
    $borrow->jumlah_pinjam = $request->input('jumlah_pinjam');
    $borrow->lama_pinjam = $request->input('lama_pinjam');
    $bungaper_bulan = 0.0083;
    $borrow->bunga = $borrow->jumlah_pinjam * $bungaper_bulan * $borrow->lama_pinjam;
    $borrow->total_pinjam = $borrow->jumlah_pinjam + $borrow->bunga;
    $borrow->sisa_bayar = max(0, $borrow->total_pinjam);

    if ($request->hasFile('foto')) {
        $imagePath = $request->file('foto')->store('borrow', 'public');
        $borrow->foto = $imagePath;
    }
    
    $borrow->save();

    return redirect()->route('borrow.index')->with('success', 'Pinjaman berhasil ditambahkan');
}



    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Pinjaman'
        ]);
        borrowM::where('id', $id)->delete();
        return redirect()->route('borrow.index')->with('success', 'Pinjaman berhasil dihapus');
    }


    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Pinjaman'
        ]);
        $subtitle = "Edit Pinjaman Produk";
        $borrow = BorrowM::find($id);
        return view('borrow_edit', compact('subtitle','borrow'));

    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Pinjaman'
        ]);
        $request->validate([
            'nomor_borrow' => 'required',
            'nama_peminjam' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jumlah_pinjam' => 'required|numeric|min:0',
            'sisa_bayar' => 'required',
            // 'status' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $borrow = BorrowM::find($id);
        $borrow->nomor_borrow = $request->input('nomor_borrow');
        $borrow->nama_peminjam = $request->input('nama_peminjam');
        $borrow->alamat = $request->input('alamat');
        $borrow->no_hp = $request->input('no_hp');
        $borrow->jumlah_pinjam = $request->input('jumlah_pinjam');
        $borrow->lama_pinjam = $request->input('lama_pinjam');
        $bungaper_bulan = 0.0083;
        $borrow->bunga = $borrow->jumlah_pinjam * $bungaper_bulan * $borrow->lama_pinjam;
        $borrow->total_pinjam = $borrow->jumlah_pinjam + $borrow->bunga;
        $borrow->sisa_bayar = $request->input('sisa_bayar');

        if ($borrow->sisa_bayar == 0) {
            $borrow->status = 'lunas';
        } else {
        $borrow->status = 'belum_lunas';
        }
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('borrow', 'public');
            $borrow->foto = $imagePath;
        }
        
        $borrow -> save();
        return redirect()->route('borrow.index')->with('success', 'Pinjaman berhasil diperbaharui');
    }


    public function pdf(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Pinjaman'
        ]);
    
        $borrowM = BorrowM::all();
    
        // Pemrosesan file foto (contoh)
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('borrow', 'public');
            // Proses penyimpanan ke model atau variabel lain, sesuai kebutuhan
        }
    
        $pdf = PDF::loadview('borrow_pdf', ['borrowM' => $borrowM]);
    
        return $pdf->stream('borrow.pdf');
    }


    public function cetak($id){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $borrowM = BorrowM::select('borrow.*')->where('borrow.id', $id)->get();
        $pdf = PDF::loadview('borrow_cetak',['borrowM' => $borrowM]);
        return $pdf->stream('borrow.cetak');
    }

}
