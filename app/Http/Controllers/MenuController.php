<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataTim;
use App\Models\DataPerusahaan;
use App\Models\User;

class MenuController extends Controller
{
    public function tentangKami()
    {
        $dataTim = DataTim::all();
        $dataPerusahaan = DataPerusahaan::all()->first();
        return view('user.Tentang_Kami',compact('dataTim','dataPerusahaan'));
    }

    public function konselor()
    {
        $konselor = User::where('user_type','konselor')->where('status_user','active')->get();
        return view('user.Konselor',compact('konselor'));
    }
}
