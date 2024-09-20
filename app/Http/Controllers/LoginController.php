<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\otpLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.Login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('/registrasi')->with('email', $request->email);
        }

        $otpCode = rand(100000, 999999);
        $expired = Carbon::now()->addMinutes(3);
        $token = otpLogin::create([
            'user_id' => $user->id,
            'otp' => $otpCode,
            'otp_expired' => $expired,
        ]);

        Mail::raw('Your OTP code is: ' . $otpCode, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your OTP Code');
        });

        session(['otp_verif' => true]);
        session(['email' => $request->email]);
        session(['otp_expired' => $expired]);

        return redirect()->back();

    }

    public function registrasi(Request $request)
    {
        $user = new User();

        $user->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $user->slug_user = trim($request->name);
        $user->email = $request->email;
        $user->name = $request->username;
        $user->phone_number = $request->phone_number;
        $user->user_type = 'user';
        $user->status_user = 'active';
        $user->save();

        $otpCode = rand(100000, 999999);
        $expired = Carbon::now()->addMinutes(3);
        $token = otpLogin::create([
            'user_id' => $user->id,
            'otp' => $otpCode,
            'otp_expired' => $expired,
        ]);

        Mail::raw('Your OTP code is: ' . $otpCode, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Your OTP Code');
        });

        session(['otp_verif' => true]);
        session(['email' => $request->email]);
        session(['otp_expired' => $expired]);

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function otp(Request $request)
    {
        $otpCode = $request->token;
        $otpCode = otpLogin::where('otp', '=', $otpCode)->first();
        $user = User::where('email', '=', session('email'))->first();
        if ($user != null){
            if ($otpCode){
                if (Auth::loginUsingId($user->id)) {
                    $request->session()->forget('otp_verif');
                    $request->session()->forget('email');
                    $request->session()->forget('otp_expired');
                    $request->session()->regenerate();
                    $otpCode->delete();
                    return redirect()->intended('/dashboard/'.$user->user_type);
                }
            }
            return redirect()->back()->with('wrong_otp','OTP yang kamu masukkan salah.');
        }
    }

    public function removeSession(Request $request){
        $user = User::where('email', session('email'))->first();
        $otpCode = otpLogin::where('user_id',$user->id)->first();
        $otpCode->delete();

        $keys = $request->input('keys');
        foreach ($keys as $key) {
            $request->session()->forget($key);
        }

        return redirect('/login');
    }
}
