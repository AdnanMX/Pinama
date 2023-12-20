<?php

namespace App\Http\Controllers;
use App\Models\BorrowM;
use App\Models\PaymentM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Pambayaran'
        ]);
        $subtitle = "Daftar Pembayaran";
        $vcari = request('search');
        $paymentM = PaymentM::select('payment.*', 'borrow.nama_peminjam', 'borrow.total_pinjam','borrow.sisa_bayar','borrow.status','payment.id AS id_pay')->join('borrow', 'borrow.id', '=', 'payment.id_payment')->where('payment.created_at', 'like', "%$vcari%")
        ->orWhere('borrow.nama_peminjam', 'like', "%$vcari%")
        ->orWhere('borrow.total_pinjam', 'like', "%$vcari%")
        ->orWhere('borrow.status', 'like', "%$vcari%")      
        ->orWhere('payment.nomor_payment', 'like', "%$vcari%")
        ->orWhere('payment.uang_bayar', 'like', "%$vcari%")
        ->orWhere('payment.bayaran', 'like', "%$vcari%")->paginate(10);
        return view('payment_index', compact('subtitle', 'paymentM','vcari'));

    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Pembayaran'
        ]);
        $subtitle = "Tambah Pembayaran";
        $borrowM = BorrowM::all();
        return view('payment_create', compact('subtitle', 'borrowM'));
    }

    public function store(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Proses Tambah Pembayaran'
    ]);
    $borrow = BorrowM::where("id", $request->input('id_payment'))->first();
    $request->validate([
        'nomor_payment' => 'required',
        'id_payment' => 'required',
        'uang_bayar' => 'required',
    ]);

    $payment = new PaymentM;
    $payment->nomor_payment = $request->input('nomor_payment');
    $payment->id_payment = $request->input('id_payment');
    $payment->uang_bayar = $request->input('uang_bayar');

    if ($borrow->sisa_bayar == '0') {
        return redirect()->route('payment.index')->with('success', 'Tidak memiliki sisa pinjam atau pembayaran telah lunas, pembayaran tidak dapat dilakukan');
    }
    if ($borrow->status == 'lunas') {
        return redirect()->route('payment.index')->with('success', 'Tidak memiliki sisa pinjam atau pembayaran telah lunas, pembayaran tidak dapat dilakukan');
    }
    if ($payment->uang_bayar > $borrow->sisa_bayar) {
        return redirect()->route('payment.index')->with('success', 'Jumlah uang yang dibayar melebihi sisa pinjaman, pembayaran tidak dapat dilakukan');
    }

    $borrow->sisa_bayar = max(0, $borrow->sisa_bayar - max(0, $payment->uang_bayar));
    if ($borrow->sisa_bayar == 0) {
        $borrow->status = 'lunas';
    } else {
    $borrow->status = 'belum_lunas';
    }
    $payment->bayaran = max(0, $borrow->sisa_bayar);

    $payment->save();
    $borrow->save();
    return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil ditambahkan');

}



    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Pembayaran'
        ]);
        paymentM::where('id', $id)->delete();
        return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil dihapus');
    }


    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Pembayaran'
        ]);

        $subtitle = "Edit Pembayaran";
        $payment = PaymentM::find($id);
        $borrowM = BorrowM::all();
        return view('payment_edit', compact('subtitle','payment','borrowM'));

    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Pembayaran'
        ]);
        $borrow = BorrowM::where("id", $request->input('id_payment'))->first();
        $request->validate([
            'nomor_payment' => 'required',
            'id_payment' => 'required',
            'uang_bayar' => 'required',
        ]);
    
        $payment = PaymentM::find($id);
        $payment->nomor_payment = $request->input('nomor_payment');

        $payment->id_payment = $request->input('id_payment');
        $payment->uang_bayar = $request->input('uang_bayar');
    
        if ($payment->uang_bayar > $borrow->total_pinjam) {
            return redirect()->route('payment.index')->with('success', 'Jumlah uang yang dibayar melebihi sisa pinjaman, pembayaran tidak dapat dilakukan');
        }
    
        $borrow->sisa_bayar = max(0, $borrow->total_pinjam - max(0, $payment->uang_bayar));
        if ($borrow->sisa_bayar == 0) {
            $borrow->status = 'lunas';
        } else {
        $borrow->status = 'belum_lunas';
        }
        $payment->bayaran = max(0, $borrow->sisa_bayar);    
    
        $payment->save();
        $borrow->save();
        return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil diperbaharui');
    }


    public function pdf(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Pembayaran'
        ]);
        $paymentM = PaymentM::select('payment.*', 'borrow.nama_peminjam', 'borrow.total_pinjam','borrow.sisa_bayar','borrow.status', 'payment.id AS id_pay')
        ->join('borrow', 'borrow.id', '=', 'payment.id_payment')->get();

        $pdf = PDF::loadview('payment_pdf',['paymentM' => $paymentM]);
        return $pdf->stream('payment.pdf');
    }


    public function cetak($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $paymentM = PaymentM::select('payment.*', 'borrow.nama_peminjam', 'borrow.total_pinjam','borrow.sisa_bayar','borrow.status', 'payment.id AS id_pay')->join('borrow', 'borrow.id', '=', 'payment.id_payment')->where('payment.id', $id)->get();
        $pdf = PDF::loadview('payment_cetak',['paymentM' => $paymentM]);
        return $pdf->stream('payment.cetak');
    }

}
