<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowC;
use App\Http\Controllers\PaymentC;
use App\Http\Controllers\KeepC;
use App\Http\Controllers\TakeC;
use App\Http\Controllers\UsersR;
use App\Http\Controllers\LoginC;
use App\Http\Controllers\LogC;

Route::get('/', function () {
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('/dashboard', function () {
    $subtitle = "Home Page";
    return view('dashboard', compact('subtitle'));
})->middleware('auth');

Route::get('borrow/pdf', [BorrowC::class, 'pdf'])->middleware('userAkses:admin,kasir');
Route::get('borrow/cetak/{id}', [BorrowC::class,'cetak'])->name('borrow.cetak')->middleware('userAkses:admin,kasir');

Route::get('borrow', [BorrowC::class, 'index'])->name('borrow.index')->middleware('userAkses:kasir,admin');
Route::get('borrow/create', [BorrowC::class, 'create'])->name('borrow.create')->middleware('userAkses:kasir,admin');
Route::post('borrow/create', [BorrowC::class, 'store'])->name('borrow.store')->middleware('userAkses:kasir,admin');

Route::get('borrow/edit/{id}', [BorrowC::class, 'edit'])->name('borrow.edit')->middleware('userAkses:admin');
Route::put('borrow/update/{id}', [BorrowC::class, 'update'])->name('borrow.update')->middleware('userAkses:admin');
Route::delete('borrow/destroy/{id}', [BorrowC::class, 'destroy'])->name('borrow.destroy')->middleware('userAkses:admin');


Route::get('payment/pdf', [PaymentC::class, 'pdf'])->middleware('userAkses:admin,kasir');
Route::get('payment/cetak/{id}', [PaymentC::class,'cetak'])->name('payment.cetak')->middleware('userAkses:admin,kasir');

Route::get('payment', [PaymentC::class, 'index'])->name('payment.index')->middleware('userAkses:kasir,admin');
Route::get('payment/create', [PaymentC::class, 'create'])->name('payment.create')->middleware('userAkses:kasir,admin');
Route::post('payment/create', [PaymentC::class, 'store'])->name('payment.store')->middleware('userAkses:kasir,admin');

Route::get('payment/edit/{id}', [PaymentC::class, 'edit'])->name('payment.edit')->middleware('userAkses:admin');
Route::put('payment/update/{id}', [PaymentC::class, 'update'])->name('payment.update')->middleware('userAkses:admin');
Route::delete('payment/destroy/{id}', [PaymentC::class, 'destroy'])->name('payment.destroy')->middleware('userAkses:admin');


Route::get('keep/pdf', [KeepC::class, 'pdf'])->middleware('userAkses:admin,kasir');
Route::get('keep/cetak/{id}', [KeepC::class,'cetak'])->name('keep.cetak')->middleware('userAkses:admin,kasir');

Route::get('keep', [KeepC::class, 'index'])->name('keep.index')->middleware('userAkses:kasir,admin');
Route::get('keep/create', [KeepC::class, 'create'])->name('keep.create')->middleware('userAkses:kasir,admin');
Route::post('keep/create', [KeepC::class, 'store'])->name('keep.store')->middleware('userAkses:kasir,admin');

Route::get('keep/edit/{id}', [KeepC::class, 'edit'])->name('keep.edit')->middleware('userAkses:admin');
Route::put('keep/update/{id}', [KeepC::class, 'update'])->name('keep.update')->middleware('userAkses:admin');
Route::delete('keep/destroy/{id}', [KeepC::class, 'destroy'])->name('keep.destroy')->middleware('userAkses:admin');


Route::get('take/pdf', [TakeC::class, 'pdf'])->middleware('userAkses:admin,kasir');
Route::get('take/cetak/{id}', [TakeC::class,'cetak'])->name('take.cetak')->middleware('userAkses:admin,kasir');

Route::get('take', [TakeC::class, 'index'])->name('take.index')->middleware('userAkses:kasir,admin');
Route::get('take/create', [TakeC::class, 'create'])->name('take.create')->middleware('userAkses:kasir,admin');
Route::post('take/create', [TakeC::class, 'store'])->name('take.store')->middleware('userAkses:kasir,admin');

Route::get('take/edit/{id}', [TakeC::class, 'edit'])->name('take.edit')->middleware('userAkses:admin');
Route::put('take/update/{id}', [TakeC::class, 'update'])->name('take.update')->middleware('userAkses:admin');
Route::delete('take/destroy/{id}', [TakeC::class, 'destroy'])->name('take.destroy')->middleware('userAkses:admin');


Route::resource('users', UsersR::class)->middleware('userAkses:admin');
Route::get('users/changepassword/{id}', [UsersR::class, 'changepassword'])->name('users.changepassword')->middleware('userAkses:admin');
Route::put('users/change/{id}', [UsersR::class, 'change'])->name('users.change')->middleware('userAkses:admin');
Route::delete('users/destroy/{id}', [UsersR::class, 'destroy'])->name('users.destroy')->middleware('userAkses:admin');

Route::resource('log', LogC::class)->middleware('userAkses:admin,kasir');

Route::get('logout', [LoginC::class, 'logout'])->name('logout');
Route::post('login', [LoginC::class, 'login_action'])->name('login.action');
Route::get('login', [LoginC::class, 'login'])->name('login');
