<?php

namespace App\Http\Controllers;
use App\Models\KeepM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KeepC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Simpanan'
        ]);
        $subtitle = "Daftar Pembayaran";
        $vcari = request('search');
        $keepM = KeepM::select('keep.*', 'keep.id AS id')->where('keep.created_at', 'like', "%$vcari%")->orWhere('keep.nama_penyimpan', 'like', "%$vcari%")->orWhere('keep.nomor_keep', 'like', "%$vcari%")->orWhere('keep.jumlah_simpan', 'like', "%$vcari%")->orWhere('keep.pajak', 'like', "%$vcari%")->orWhere('keep.total_simpan', 'like', "%$vcari%")->orWhere('keep.sisa_simpan', 'like', "%$vcari%")->paginate(10);
        return view('keep_index', compact('subtitle', 'keepM','vcari'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Simpanan'
        ]);
        $subtitle = "Tambah Pembayaran";
        return view('keep_create', compact('subtitle'));
    }

    public function store(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Proses Tambah Simpanan'
    ]);

    $request->validate([
        'nomor_keep' => 'required',
        'nama_penyimpan' => 'required',
        'jumlah_simpan' => 'required|numeric|min:0',
    ]);

    $keep = new KeepM;
    $keep->nomor_keep = $request->input('nomor_keep');
    $keep->nama_penyimpan = $request->input('nama_penyimpan');
    $keep->jumlah_simpan = $request->input('jumlah_simpan');
    $keep->pajak = $keep->jumlah_simpan * 0.05;
    $keep->total_simpan = $keep->jumlah_simpan - $keep->pajak;
    $keep->sisa_simpan =  $keep->total_simpan;


    
    $keep->save();

    return redirect()->route('keep.index')->with('success', 'Simpanan berhasil ditambahkan');
}



    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Simpanan'
        ]);
        keepM::where('id', $id)->delete();
        return redirect()->route('keep.index')->with('success', 'Simpanan berhasil dihapus');
    }


    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Simpanan'
        ]);
        $subtitle = "Edit Simpanan Produk";
        $keep = KeepM::find($id);
        return view('keep_edit', compact('subtitle','keep'));

    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Simpanan'
        ]);
        $request->validate([
            'nomor_keep' => 'required',
            'nama_penyimpan' => 'required',
            'jumlah_simpan' => 'required|numeric|min:0',
        ]);

        $keep = KeepM::find($id);
        $keep->nomor_keep = $request->input('nomor_keep');
        $keep->nama_penyimpan = $request->input('nama_penyimpan');
        $keep->jumlah_simpan = $request->input('jumlah_simpan');
        $keep->pajak = $keep->jumlah_simpan * 0.05;
        $keep->total_simpan = $keep->jumlah_simpan - $keep->pajak;
        $keep->sisa_simpan = max(0, $keep->total_simpan);
    
        
        $keep -> save();
        return redirect()->route('keep.index')->with('success', 'Simpanan berhasil diperbaharui');
    }


    public function pdf(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Simpanan'
        ]);
    
        $keepM = KeepM::all();
    
        // Pemrosesan file foto (contoh)
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('keep', 'public');
            // Proses penyimpanan ke model atau variabel lain, sesuai kebutuhan
        }
    
        $pdf = PDF::loadview('keep_pdf', ['keepM' => $keepM]);
    
        return $pdf->stream('keep.pdf');
    }


    public function cetak($id){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $keepM = KeepM::select('keep.*')->where('keep.id', $id)->get();
        $pdf = PDF::loadview('keep_cetak',['keepM' => $keepM]);
        return $pdf->stream('keep.cetak');
    }

}
