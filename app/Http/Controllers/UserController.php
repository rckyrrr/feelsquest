<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QOTD;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\transaction;
use App\Models\counseling;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('user.Profile',compact('user'));
    }

    public function dashboard()
    {
        $qotd = QOTD::inRandomOrder()->first();
        $tests = Test::all();
        if (!Cache::has('qotd')) {
            $qotd = QOTD::inRandomOrder()->first();
            Cache::put('qotd', $qotd->qotd, 60 * 24);
        }
        $transaction = transaction::where('klien_id', Auth::user()->id)->where('transaction_status','ongoing')->first();
        $old_counseling = counseling::where('klien_id',Auth::user()->id)->where('status_counseling','completed')->latest()->first();
        if($transaction){
            $next_counseling = counseling::where('klien_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('status_counseling', 'scheduled')
                    ->orWhere('status_counseling', 'ongoing');
            })->orderBy('counseling_date','asc')
            ->first();
            if($next_counseling){
                $counselor = User::where('id',$next_counseling->counselor_id)->first();
                return view('user.Dashboard',compact('tests','transaction','counselor','next_counseling','old_counseling'));
            }else{
                return view('user.Dashboard',compact('tests','transaction','next_counseling','old_counseling'));
            }
        }else{
            return view('user.Dashboard',compact('tests','transaction'));
        }
    }

    public function testMental()
    {
        $qotd = QOTD::inRandomOrder()->first();

        if (!Cache::has('qotd')) {
            $qotd = QOTD::inRandomOrder()->first();
            Cache::put('qotd', $qotd->qotd, 60 * 24);
        }
        $tests = Test::all();
        return view('user.Dashboard_Tes_Mental',compact('tests'));
    }

    public function editProfile(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('uuid',$user_id)->first();
        return view('user.editProfile',compact('user'));
    }

    public function editedProfile (Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('uuid',$user_id)->first();
        if ($user->user_type == 'user'){

            $user->name = $request->username;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->umur = $request->umur;
            $user->phone_number = $request->nomer_hp;
            if($request->hasFile('foto')){
                $foto = 'Profile'. Auth::user()->name . '-' . time()
                        . '.' . $request->foto->extension();
                        $request->foto->move(public_path('image_uploaded/image_user'), $foto);
                $fotoLamaPath = public_path('image_uploaded/image_user/') . $user->foto;
                if (File::exists($fotoLamaPath)) {
                    File::delete($fotoLamaPath);
                }
                $user->foto = $foto;
            }
            $user->kota = ucfirst($request->kota);
            $user->pekerjaan = ucfirst($request->pekerjaan);
            $user->save();
        }elseif($user->user_type == 'konselor'){
            $user->name = $request->username;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->umur = $request->umur;
            $user->phone_number = $request->nomer_hp;
            if($request->hasFile('foto')){
                $foto = 'Profile'. Auth::user()->name . '-' . time()
                        . '.' . $request->foto->extension();
                        $request->foto->move(public_path('image_uploaded/image_user'), $foto);
                $fotoLamaPath = public_path('image_uploaded/image_user/') . $user->foto;
                if (File::exists($fotoLamaPath)) {
                    File::delete($fotoLamaPath);
                }
                $user->foto = $foto;
            }
            $user->kota = ucfirst($request->kota);
            $user->bahasa = ucfirst($request->bahasa);
            $user->keahlian_utama = $request->keahlian_utama;
            $user->keahlian_lainnya = $request->keahlian_lainnya;
            $user->pendekatan = $request->pendekatan;
            $user->save();
        }

        return redirect('/profile/user');
    }
}
