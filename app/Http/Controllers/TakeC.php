<?php

namespace App\Http\Controllers;
use App\Models\KeepM;
use App\Models\TakeM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TakeC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Pengambilan'
        ]);
        $subtitle = "Daftar Pengambilan";
        $vcari = request('search');
        $takeM = TakeM::select('take.*', 'keep.nama_penyimpan','keep.sisa_simpan','take.id AS id_tek')->join('keep', 'keep.id', '=', 'take.id_take')->where('take.created_at', 'like', "%$vcari%")
        ->orWhere('keep.nama_penyimpan', 'like', "%$vcari%")
        ->orWhere('take.nomor_take', 'like', "%$vcari%")
        ->orWhere('take.nama_pengambil', 'like', "%$vcari%")
        ->orWhere('take.uang_ambil', 'like', "%$vcari%")
        ->orWhere('take.lama_ambil', 'like', "%$vcari%")
        ->orWhere('take.bunga', 'like', "%$vcari%")
        ->orWhere('take.total_ambil', 'like', "%$vcari%")
        ->orWhere('take.total_simpan', 'like', "%$vcari%")
        ->orWhere('take.simpanan', 'like', "%$vcari%")->paginate(10);
        return view('take_index', compact('subtitle', 'takeM','vcari'));

    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Pengambilan'
        ]);
        $subtitle = "Tambah Pengambilan";
        $keepM = KeepM::all();
        return view('take_create', compact('subtitle', 'keepM'));
    }

    public function store(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Proses Tambah Pengambilan'
    ]);
    $keep = KeepM::where("id", $request->input('id_take'))->first();
    $request->validate([
        'nomor_take' => 'required',
        'nama_pengambil' => 'required',
        'id_take' => 'required',
        'uang_ambil' => 'required',
        'lama_ambil' => 'required',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $take = new TakeM;
    $take->total_simpan = max(0, $keep->sisa_simpan);
    $take->nomor_take = $request->input('nomor_take');
    $take->nama_pengambil = $request->input('nama_pengambil');
    $take->id_take = $request->input('id_take');
    $take->uang_ambil = $request->input('uang_ambil');

    if ($keep->sisa_simpan == '0') {
        return redirect()->route('take.index')->with('success', 'Tidak memiliki simpanan untuk di ambil, pengambilan tidak dapat dilakukan');
    }

    if ($take->uang_ambil > $keep->sisa_simpan) {
        return redirect()->route('take.index')->with('success', 'Jumlah uang yang diambil melebihi sisa simpanan, pengambilan tidak dapat dilakukan');
    }
    

    $take->lama_ambil = $request->input('lama_ambil');
    $bungaper_bulan = 0.0050;
    $take->bunga = $keep->sisa_simpan * $bungaper_bulan * $take->lama_ambil;
    $take->total_ambil = $take->uang_ambil + $take->bunga;
    $keep->sisa_simpan = max(0, $keep->sisa_simpan - max(0, $take->uang_ambil));
    $take->simpanan = max(0, $keep->sisa_simpan);


    if ($request->hasFile('foto')) {
        $imagePath = $request->file('foto')->store('take', 'public');
        $take->foto = $imagePath;
    }
    $take->save();
    $keep->save();
    return redirect()->route('take.index')->with('success', 'Pengambilan berhasil ditambahkan');

}


    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Pengambilan'
        ]);
        takeM::where('id', $id)->delete();
        return redirect()->route('take.index')->with('success', 'Pengambilan berhasil dihapus');
    }


    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Pengambilan'
        ]);

        $subtitle = "Edit Pengambilan";
        $take = TakeM::find($id);
        $keepM = KeepM::all();
        return view('take_edit', compact('subtitle','take','keepM'));

    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Pengambilan'
        ]);
        $keep = KeepM::where("id", $request->input('id_take'))->first();
        $request->validate([
            'nomor_take' => 'required',
            'nama_pengambil' => 'required',
            'id_take' => 'required',
            'uang_ambil' => 'required',
            'lama_ambil' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $take = TakeM::find($id);
        
        $take->nomor_take = $request->input('nomor_take');
        $take->nama_pengambil = $request->input('nama_pengambil');
        $take->id_take = $request->input('id_take');
        $take->uang_ambil = $request->input('uang_ambil'); 
    
        if ($take->uang_ambil > $take->total_simpan) {
            return redirect()->route('take.index')->with('success', 'Jumlah uang yang diambil melebihi sisa simpanan, pengambilan tidak dapat dilakukan');
        }
        
        $take->lama_ambil = $request->input('lama_ambil');
        $bungaper_bulan = 0.0050;
        $take->bunga = $take->total_simpan * $bungaper_bulan * $take->lama_ambil;
        $take->total_ambil = $take->uang_ambil + $take->bunga;
        $keep->sisa_simpan = max(0, $take->total_simpan - max(0, $take->uang_ambil));
        $take->simpanan = max(0, $keep->sisa_simpan);

        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('take', 'public');
            $take->foto = $imagePath;
        }
        $take->save();
        $keep->save();
        return redirect()->route('take.index')->with('success', 'Pengambilan berhasil diperbaharui');
    }


    public function pdf(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Pengambilan'
        ]);
        $takeM = TakeM::select('take.*', 'keep.nama_penyimpan', 'keep.total_simpan','keep.sisa_simpan', 'take.id AS id_tek')
        ->join('keep', 'keep.id', '=', 'take.id_take')->get();

        $pdf = PDF::loadview('take_pdf',['takeM' => $takeM]);
        return $pdf->stream('take.pdf');
    }


    public function cetak($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $takeM = TakeM::select('take.*', 'keep.nama_penyimpan', 'keep.total_simpan','keep.sisa_simpan', 'take.id AS id_tek')->join('keep', 'keep.id', '=', 'take.id_take')->where('take.id', $id)->get();
        $pdf = PDF::loadview('take_cetak',['takeM' => $takeM]);
        return $pdf->stream('take.cetak');
    }

}
