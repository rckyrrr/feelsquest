<?php

namespace App\Http\Controllers;

use App\Models\counseling;
use App\Models\transaction;
use App\Models\package;
use App\Models\User;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Google_Service_Calendar_Event;
use Google\Client as GoogleClient;
use Google\Service\Calendar;

use Illuminate\Http\Request;

class CounselingController extends Controller
{

    public function calender(Request $request)
    {
        $counseling = counseling::where('counselingUUID',session('counseling_uuid'))->first();
        $startDateTime = Carbon::parse($counseling->counseling_date . ' ' . $counseling->counseling_start)->format('Y-m-d\TH:i:sP');
        if ($counseling->counseling_start === '12:00') {
            $startDateTime = Carbon::parse($counseling->counseling_date . ' ' . $counseling->counseling_start)->format('Y-m-d\TH:i:sP');
        }

        $endDateTime = Carbon::parse($counseling->counseling_date . ' ' . $counseling->counseling_start)->addHour()->format('Y-m-d\TH:i:sP');
        if(Auth::user()->user_type == 'konselor'){
            if(session('calendar')){
                $googleEvent = new \Google_Service_Calendar_Event([
                    'summary' => 'Konseling dengan '.$counseling->counselor->name,
                    'description' => 'Konselor: ' . $counseling->counselor->name . "\n" . 'Pra Konseling: ' . $counseling->issues,
                    'start' => [
                        'dateTime' => $startDateTime,
                        'timeZone' => 'Asia/Jakarta',
                    ],
                    'end' => [
                        'dateTime' => $endDateTime,
                        'timeZone' => 'Asia/Jakarta',
                    ],
                ]);
            }else{
                $googleEvent = new \Google_Service_Calendar_Event([
                    'summary' => 'Konseling dengan '.$counseling->counselor->name,
                    'description' => 'Klien: ' . $counseling->klien->name . "\n" . 'Pra Konseling: ' . $counseling->issues,
                    'start' => [
                        'dateTime' => $startDateTime,
                        'timeZone' => 'Asia/Jakarta',
                    ],
                    'end' => [
                        'dateTime' => $endDateTime,
                        'timeZone' => 'Asia/Jakarta',
                    ],
                    'conferenceData' => [
                        'createRequest' => [
                            'conferenceSolutionKey' => [
                                'type' => 'hangoutsMeet',
                            ],
                            'requestId' => uniqid(),
                        ],
                    ],
                    'attendees' => [
                        [
                            'email' => $counseling->klien->email, // Email peserta 1
                            'responseStatus' => 'accepted', // Status tanggapan peserta 1
                        ],
                    ],
                ]);
            }
        }elseif(Auth::user()->user_type == 'user'){
            $conferenceLink = $counseling->link_meet;
            $googleEvent = new \Google_Service_Calendar_Event([
                'summary' => 'Konseling dengan '.$counseling->counselor->name,
                'description' => 'Konselor: ' . $counseling->counselor->name . "\n" . 'Pra Konseling: ' . $counseling->issues,
                'start' => [
                    'dateTime' => $startDateTime,
                    'timeZone' => 'Asia/Jakarta',
                ],
                'end' => [
                    'dateTime' => $endDateTime,
                    'timeZone' => 'Asia/Jakarta',
                ],
            ]);
        }

        $googleClient = new \Google_Client();
        $googleClient->setApplicationName('Feelsbox');
        $googleClient->setScopes([\Google_Service_Calendar::CALENDAR]);
        $googleClient->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
        $googleClient->setAccessType('offline');
        $googleClient->setPrompt('select_account consent');

        $authorizationCode = $request->get('code');
        $accessToken = $googleClient->fetchAccessTokenWithAuthCode($authorizationCode);

        $googleClient->setAccessToken($accessToken);

        if ($googleClient->isAccessTokenExpired()) {
            $googleClient->fetchAccessTokenWithRefreshToken($googleClient->getRefreshToken());
        }

        $calendarService = new \Google_Service_Calendar($googleClient);

        $createdEvent = $calendarService->events->insert('primary', $googleEvent, ['conferenceDataVersion' => 1]);

        if (Auth::user()->user_type == 'konselor'){
            if(session('calendar')){
                $request->session()->forget('calendar');
                return redirect('/dashboard/konselor');
            }else{
                $meetLink = $createdEvent->getHangoutLink();

                $counseling->link_meet = $meetLink;
                $counseling->status_counseling = 'ongoing';
                $counseling->save();
                $request->session()->forget('counseling_uuid');
                return redirect('/konseling/konselor');
            }

        }elseif(Auth::user()->user_type == 'user'){
            $request->session()->forget('counseling_uuid');
            return redirect('/konseling/user');
        }

    }

    public function callback(Request $request)
    {
        session(['counseling_uuid' => $request->counseling_id]);
        if(isset($request->btn_id)){
            session(['calendar' => true]);
        }
        $googleClient = new GoogleClient();
        $googleClient->setApplicationName('Feelsbox');
        $googleClient->setScopes([Calendar::CALENDAR]);
        $googleClient->setAuthConfig(storage_path('app/google-calendar/credentials.json')); // Path ke file JSON kredensial Google API Anda
        $googleClient->setAccessType('offline');
        $googleClient->setPrompt('select_account consent');

        // Membuat instance Google Calendar API
        $calendarService = new Calendar($googleClient);

        // Mengotentikasi pengguna individu
        $authUrl = $googleClient->createAuthUrl();

        return redirect($authUrl);
    }


    public function index()
    {
        $historyCounseling = counseling::where('klien_id',Auth::user()->id)->orderBy('counseling_date','asc')->get();
        $transaction = transaction::where('klien_id', Auth::user()->id)->where('transaction_status','ongoing')->first();
        if($transaction){
            // $currentDate = date('Y-m-d');
            // $currentTime = date('H:i:s');
            $currentYear = date('Y');
            $next_counseling = counseling::where('klien_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('status_counseling', 'scheduled')
                    ->orWhere('status_counseling', 'ongoing');
            })->orderBy('counseling_date','asc')
            ->first();
            $old_counseling = counseling::where('klien_id',Auth::user()->id)->where('status_counseling','completed')->latest()->first();
            $counseling = counseling::where('transaction_id',$transaction->id)->first();
            if($next_counseling != null){
                $counselor = User::where('id',$next_counseling->counselor_id)->first();
                return view('user.Konseling',compact('transaction','counselor','historyCounseling','next_counseling','currentYear','old_counseling'));
            }
            return view('user.Konseling',compact('transaction','historyCounseling','next_counseling','old_counseling','currentYear'));
        }else{
            return view('user.Konseling',compact('transaction','historyCounseling'));
        }


    }

    public function paketKonseling(Request $request)
    {
        if($request->has('prakonseling')){
            $prakonseling = $request->prakonseling;
            $package = package::all();
            return view('user.Paket_Konseling',compact('package','prakonseling'));
        }else{
            $package = package::all();
            return view('user.Paket_Konseling',compact('package'));
        }

    }

    public function jadwalKonseling(Request $request)
    {

        if($request->has('prakonseling')){
            $prakonseling = $request->prakonseling;
            $packageID = $request->packageID;
            if($request->has('tanggal')){
                $konselors = User::where('user_type', 'konselor')
                ->whereNotExists(function ($query) use ($request) {
                    $query->select(DB::raw(1))
                        ->from('jadwal_sibuks')
                        ->whereRaw('users.id = jadwal_sibuks.counselor_id')
                        ->where('jadwal_sibuks.jadwal_date', '=', $request->tanggal)
                        ->where('jadwal_sibuks.jadwal_time', '=', $request->jam);
                })
                ->get();

                $tanggal = $request->tanggal;
                $jam = $request->jam;
                $currentYear = date('Y');

                return view('user.Jadwal_Konseling',compact('konselors','packageID','tanggal','jam','currentYear','prakonseling'));
            }else{
                return view('user.Jadwal_Konseling',compact('packageID','prakonseling'));
            }
        }else{
            $packageID = $request->packageID;
            if($request->has('tanggal')){
                $konselors = User::where('user_type', 'konselor')
                ->whereNotExists(function ($query) use ($request) {
                    $query->select(DB::raw(1))
                        ->from('jadwal_sibuks')
                        ->whereRaw('users.id = jadwal_sibuks.counselor_id')
                        ->where('jadwal_sibuks.jadwal_date', '=', $request->tanggal)
                        ->where('jadwal_sibuks.jadwal_time', '=', $request->jam);
                })
                ->get();

                $tanggal = $request->tanggal;
                $jam = $request->jam;
                $currentYear = date('Y');

                return view('user.Jadwal_Konseling',compact('konselors','packageID','tanggal','jam','currentYear'));
            }else{
                return view('user.Jadwal_Konseling',compact('packageID'));
            }
        }

    }

    public function praCounseling(Request $request)

    {
        if($request->has('prakonseling')){
            $prakonseling = $request->prakonseling;
            $packageID = $request->packageID;
            $counselorID = $request->counselorID;
            $tanggal = $request->tanggal;
            $jam = $request->jam;
            $transaction = transaction::where('klien_id', Auth::user()->id)->where('transaction_status','ongoing')->first();

            return view('user.Pra_Konseling', compact('packageID','counselorID','transaction','tanggal','jam','prakonseling'));
        }else{
            $packageID = $request->packageID;
            $counselorID = $request->counselorID;
            $tanggal = $request->tanggal;
            $jam = $request->jam;
            $transaction = transaction::where('klien_id', Auth::user()->id)->where('transaction_status','ongoing')->first();

            return view('user.Pra_Konseling', compact('packageID','counselorID','transaction','tanggal','jam'));
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $counselorID = $request->counselorID;
        $counselor = User::where('uuid',$counselorID)->first();
        $transaction = transaction::where('klien_id', Auth::user()->id)->where('payment_status','paid')->where('transaction_status','ongoing')->first();

        $transaction->session_remaining = $transaction->session_remaining - 1;
        $transaction->save();

        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $jam_array = explode(' - ', $jam);
        $start_time = $jam_array[0];
        $end_time = $jam_array[1];

        $counseling = new counseling();
        $counseling->counselingUUID = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $counseling->counselor_id = $counselor->id;
        $counseling->transaction_id = $transaction->id;
        $counseling->klien_id = Auth::user()->id;
        $counseling->issues = $request->issues;
        $counseling->counseling_date = $tanggal;
        $counseling->counseling_start = date('H:i:s', strtotime($start_time));
        $counseling->counseling_end = date('H:i:s', strtotime($end_time));
        $counseling->status_counseling = 'scheduled';
        $counseling->save();

        $testResult = TestResult::where('klien_id',Auth::user()->id)->where('status_result','withCounselor')->get();
        foreach($testResult as $result){
            $result->counselor_id = $counseling->counselor_id;
            $result->status_result = 'withCounselor';
            $result->save();
        }

        return redirect('/konseling/user');
    }

   public function detailKonseling(Request $request)
   {
        $detailCounseling = counseling::where('counselingUUID',$request->counseling_id)->first();
        return view('user.Konseling_Detail',compact('detailCounseling'));
   }

   public function feedbackUser(Request $request)
   {
        $counseling = counseling::where('counselingUUID',$request->counseling_id)->first();
        $counseling->counselingResult->feedback_user = $request->pengalaman;
        $counseling->counselingResult->masukan_user = $request->masukan;
        $counseling->counselingResult->save();

        return redirect()->back();
   }
}
