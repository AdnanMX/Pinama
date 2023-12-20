<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;

class LogC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Log'
        ]);

        $subtitle = "Daftar aktivitas";
        $logM = LogM::select('users.*','log.*')->join('users','users.id', '=', 'log.id_user')->get();
        return view('log_index', compact('subtitle', 'logM'));
    }

}
