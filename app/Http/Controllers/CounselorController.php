<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\counseling;
use App\Models\CounselingResult;
use App\Models\TestResult;
use App\Models\TestQuestion;
use App\Models\transaction;
use App\Models\JadwalSibuk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Charts\TotalCounseling;
use App\Charts\TotalPemasukanCounselorChart;
use App\Charts\TotalAnalisisChart;
use Carbon\Carbon;

class CounselorController extends Controller
{
    public function dashboard (TotalCounseling $totalCounseling,TotalPemasukanCounselorChart $totalPemasukan,TotalAnalisisChart $totalAnalisis)
    {
        $monthlyData = counseling::where('counselor_id',Auth::user()->id)->where('status_counseling','completed')->get();
        $totalAnalisisAll = TestResult::where('counselor_id', Auth::user()->id)->where('status_result','completed')->get();
        $next_counseling = counseling::where('counselor_id',Auth::user()->id)->where('status_counseling','scheduled')->orWhere('status_counseling','ongoing')->first();
        return view('konselor.Dashboard_Konselor',compact('monthlyData','next_counseling','totalAnalisisAll'),['totalCounseling' => $totalCounseling->build(),'totalPemasukan' => $totalPemasukan->build(),'totalAnalisis' => $totalAnalisis->build()]);
    }

    public function konseling()
    {
        $totalKlien = counseling::where('counselor_id', Auth::user()->id)->distinct('klien_id')->count();
        $totalScheduled = counseling::where('counselor_id', Auth::user()->id)->where('status_counseling','scheduled')->count();
        $totalCompleted = counseling::where('counselor_id', Auth::user()->id)->where('status_counseling','completed')->count();
        $startDateThisMonth = Carbon::now()->startOfMonth();

        // Mendapatkan tanggal awal bulan lalu
        $startDateLastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Menghitung jumlah klien pada bulan ini
        $totalKlienThisMonth = counseling::where('counselor_id', Auth::user()->id)
            ->where('created_at', '>=', $startDateThisMonth)
            ->distinct('klien_id')
            ->count();

        // Menghitung jumlah klien pada bulan lalu
        $totalKlienLastMonth = counseling::where('counselor_id', Auth::user()->id)
            ->whereBetween('created_at', [$startDateLastMonth, $startDateThisMonth])
            ->distinct('klien_id')
            ->count();
        if ($totalKlienLastMonth != 0) {
            $persentasePerubahan = (($totalKlienThisMonth - $totalKlienLastMonth) / $totalKlienLastMonth) * 100;
        } else {
            $persentasePerubahan = 0;
        }

        $totalScheduledThisMonth = counseling::where('counselor_id', Auth::user()->id)
            ->where('created_at', '>=', $startDateThisMonth)
            ->where('status_counseling','scheduled')
            ->count();


        $totalScheduledLastMonth = counseling::where('counselor_id', Auth::user()->id)
            ->whereBetween('created_at', [$startDateLastMonth, $startDateThisMonth])
            ->where('status_counseling','scheduled')
            ->count();

        $totalCompletedThisMonth = counseling::where('counselor_id', Auth::user()->id)
            ->where('created_at', '>=', $startDateThisMonth)
            ->where('status_counseling','completed')
            ->count();

        // Menghitung jumlah klien pada bulan lalu
        $totalCompletedLastMonth = counseling::where('counselor_id', Auth::user()->id)
            ->whereBetween('created_at', [$startDateLastMonth, $startDateThisMonth])
            ->where('status_counseling','completed')
            ->count();

        if ($totalKlienLastMonth != 0) {
            $persentasePerubahan = (($totalKlienThisMonth - $totalKlienLastMonth) / $totalKlienLastMonth) * 100;
        } else {
            $persentasePerubahan = 0;
        }

        if ($totalScheduledLastMonth != 0) {
            $persentasePerubahanScheduled = (($totalScheduledThisMonth - $totalScheduledLastMonth) / $totalScheduledLastMonth) * 100;
        } else {
            $persentasePerubahanScheduled = 0;
        }

        if ($totalCompletedLastMonth != 0) {
            $persentasePerubahanCompleted = (($totalCompletedThisMonth - $totalCompletedLastMonth) / $totalCompletedLastMonth) * 100;
        } else {
            $persentasePerubahanCompleted = 0;
        }
        $jadwalCounseling = counseling::where('counselor_id',Auth::user()->id)->Where('status_counseling','scheduled')->orWhere('status_counseling','ongoing')->orWhere('status_counseling','completed')->get();
        $jadwalSibuk = JadwalSibuk::where('counselor_id',Auth::user()->id)->get();
        return view('konselor.Dashboard_Konseling',compact('jadwalCounseling','totalKlien','persentasePerubahan','jadwalSibuk','totalScheduled','totalCompleted','persentasePerubahanScheduled','persentasePerubahanCompleted'));
    }

    public function sesiCounseling(Request $request)
    {
        $counseling_uuid = $request->counseling_id;
        $detailCounseling = counseling::where('counselingUUID',$counseling_uuid)->first();
        return view('konselor.Dashboard_Sesi_Konseling',compact('detailCounseling'));
    }

    public function endCounseling(Request $request)
    {
        $counseling = counseling::where('counselingUUID', $request->counseling_id)->first();
        $counseling->status_counseling = 'completed';
        $counseling->save();

        $counselingResult = new CounselingResult();
        $counselingResult->resultCounseling_uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));;
        $counselingResult->counseling_id = $counseling->id;
        $counselingResult->permasalahan = $request->permasalahan;
        $counselingResult->catatan = $request->catatan;
        $counselingResult->save();

        $count = counseling::where('transaction_id',$counseling->transaction_id)->where('status_counseling','completed')->get();
        $transaction = transaction::where('id',$counseling->transaction_id)->first();
        if ($transaction->package->total_sessions == $count->count()){
            $transaction->transaction_status = 'completed';
            $transaction->save();
        }


        return redirect('/konseling/konselor/evaluasi-konseling?counseling_id='.$request->counseling_id);
    }

    public function addEvaluasiCounseling(Request $request)
    {
        $counselingResult = CounselingResult::where('resultCounseling_uuid',$request->counselingResult_id)->first();
        $counselingResult->evaluasi_psikis = $request->evaluasi_psikis;
        $counselingResult->hal_diperhatikan = $request->hal;
        $counselingResult->saran = $request->saran;
        $counselingResult->save();

        return redirect('/konseling/konselor');
    }
    public function evaluasiCounseling(Request $request)
    {
        $counseling_uuid = $request->counseling_id;
        $detailCounseling = counseling::where('counselingUUID',$counseling_uuid)->first();
        return view('konselor.Dashboard_Evaluasi_Konseling',compact('detailCounseling'));
    }

    public function detailCounseling(Request $request)
    {
        $counseling_uuid = $request->counseling_id;
        $detailCounseling = counseling::where('counselingUUID',$counseling_uuid)->first();
        return view('konselor.Dashboard_Detail_Konseling',compact('detailCounseling'));
    }

    public function test()
    {
        $testResult = TestResult::where('counselor_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $totalTestResult = TestResult::where('counselor_id',Auth::user()->id)->count();
        $completedTestResult = TestResult::where('counselor_id',Auth::user()->id)->where('status_result','completed')->count();
        $noTestResult = TestResult::where('counselor_id',Auth::user()->id)->where('status_result','withCounselor')->count();
        return view('konselor.Dashboard_Tes_Mental',compact('testResult','totalTestResult','completedTestResult','noTestResult'));
    }

    public function perkembanganTest(Request $request)
    {
        $testResult = TestResult::where('testResult_uuid',$request->testResult_id)->first();
        $dataGrafik = TestResult::where('klien_id',$testResult->klien->id)->get();
        return view('konselor.Dashboard_Perkembangan_Tes',compact('testResult','dataGrafik'));
    }

    public function addPerkembangan(Request $request)
    {
        $testResult = TestResult::where('testResult_uuid',$request->testResult_id)->first();
        $testResult->penjelasan_singkat = $request->penjelasan;
        $testResult->solusi = $request->solusi;
        if($testResult->hasil_analisis != null){
            $testResult->status_result = 'completed';
        }
        $testResult->save();

        return redirect('/tes-mental/konselor');
    }

    public function hasilTest(Request $request)
    {
        $testResult = TestResult::where('testResult_uuid',$request->testResult_id)->first();
        $testQuestion = TestQuestion::where('test_id',$testResult->test_id)->get();
        return view('konselor.Dashboard_Analisis_Tes',compact('testResult','testQuestion'));
    }

    public function addHasilTest(Request $request)
    {
        $testResult = TestResult::where('testResult_uuid',$request->testResult_id)->first();
        $testResult->hasil_analisis = $request->hasil_analisis;
        $testResult->saran = $request->saran;
        if($testResult->penjelasan_singkat != null){
            $testResult->status_result = 'completed';
        }
        $testResult->save();

        return redirect('/tes-mental/konselor');
    }

    public function addJadwalSibuk(Request $request)
    {
        $jadwalSibuk = new JadwalSibuk();
        $jadwalSibuk->counselor_id = Auth::user()->id;
        $jadwalSibuk->jadwal_date = $request->tanggal;
        $jadwalSibuk->jadwal_time = $request->jam;
        $jadwalSibuk->save();
        return redirect('/konseling/konselor');
    }

    public function deleteJadwalSibuk($id)
    {
        $jadwalSibuk = JadwalSibuk::find($id);
        $jadwalSibuk->delete();
        return redirect('/konseling/konselor');
    }

    public function keuanganCounselor(){
        $totalPendapatan = counseling::where('status_counseling', 'completed')
        ->where('counselor_id', Auth::user()->id)
        ->selectRaw('COUNT(*) * 125000 AS total_pendapatan, DATE_FORMAT(created_at, "%Y-%m") AS counselingmonth')
        ->groupBy('counselingmonth')
        ->get();
        $allMonthsPendapatan = $totalPendapatan->pluck('counselingmonth')->toArray();
        $counseling = counseling::where('status_counseling','completed')->where('counselor_id',Auth::user()->id)->count();
        $total = $counseling * 125000;
        return view('konselor.Dashboard_Keuangan',compact('totalPendapatan','allMonthsPendapatan','total'));
    }
}
