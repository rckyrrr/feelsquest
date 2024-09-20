<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use App\Models\package;
use App\Models\Faq;
use App\Models\QOTD;
use App\Models\User;
use App\Models\Coupon;
use App\Models\counseling;
use App\Models\transaction;
use App\Models\DataPerusahaan;
use App\Models\DataTim;
use App\Charts\UserChart;
use App\Charts\CounselorChart;
use App\Charts\UserByGenderChart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index(UserByGenderChart $userbyGenderChart)
    {
        $totalKlien = User::where('user_type','user')->get();
        $mostCounselor = counseling::where('status_counseling', 'completed')
            ->groupBy('counselor_id')
            ->select('counselor_id', DB::raw('count(*) as total'))
            ->orderByDesc('total')
            ->first();
        $mostPackage = transaction::where('transaction_status', 'completed')
            ->groupBy('package_id')
            ->select('package_id', DB::raw('count(*) as total'))
            ->orderByDesc('total')
            ->first();

        $grossProfit = transaction::where('transaction_status', 'completed')
            ->selectRaw('SUM(gross_amount) AS total_amount, DATE_FORMAT(created_at, "%Y-%m") AS transaction_month')
            ->groupBy('transaction_month')
            ->get();

        $allMonthsGross = $grossProfit->pluck('transaction_month')->toArray();

        $netProfits = [];

        foreach ($grossProfit as $a) {
            $transaction_month = $a->transaction_month;

            $total_counseling = counseling::where('status_counseling', 'completed')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$transaction_month])
                ->count();

            $total_biaya = $total_counseling * 125000;

            $netProfit = $a->total_amount - $total_biaya;

            $netProfits[] = [
                'transaction_month' => $transaction_month,
                'net_profit' => $netProfit,
            ];
        }
        return view('admin.Dashboard_Admin',compact('totalKlien','mostCounselor','mostPackage','grossProfit','allMonthsGross','netProfits'),['userbyGenderChart' => $userbyGenderChart->build()]);
    }

    public function dataFinancial()
    {
        $grossProfit = transaction::where('transaction_status', 'completed')
            ->selectRaw('SUM(gross_amount) AS total_amount, DATE_FORMAT(created_at, "%Y-%m") AS transaction_month')
            ->groupBy('transaction_month')
            ->get();

        $allMonthsGross = $grossProfit->pluck('transaction_month')->toArray();

        $netProfits = [];

        foreach ($grossProfit as $a) {
            $transaction_month = $a->transaction_month;

            $total_counseling = counseling::where('status_counseling', 'completed')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$transaction_month])
                ->count();

            $total_biaya = $total_counseling * 125000;

            $netProfit = $a->total_amount - $total_biaya;

            $netProfits[] = [
                'transaction_month' => $transaction_month,
                'net_profit' => $netProfit,
            ];
        }

        $grossProfits = transaction::where('transaction_status', 'completed')
            ->selectRaw('SUM(gross_amount) AS total_gross')
            ->first();

        $ac = counseling::where('status_counseling', 'completed')->count();
        $tb = $ac * 125000;

        $totalNetProfit = $grossProfits->total_gross - $tb;
        $netProfitMargin = ($totalNetProfit / $grossProfits->total_gross) * 100;

        // $netProfitMargin = transaction::where('transaction_status', 'completed')
        //     ->selectRaw('ROUND(((SUM(gross_amount) - ((SELECT COUNT(*) FROM counselings WHERE status_counseling = "completed") * 125000)) / SUM(gross_amount)) * 100, 2) AS net_amount')
        //     ->first();

        $totalCompleted = counseling::where('status_counseling','completed')->count();
        return view('admin.Dashboard_Keuangan',compact('grossProfit','allMonthsGross','netProfits','netProfitMargin','totalCompleted'));
    }

    public function dataUser(UserChart $chart,CounselorChart $counselor_chart)
    {
        $total_user = User::where('user_type','user')->get();
        $total_counselor = User::where('user_type','konselor')->get();
        $data_user = User::where('status_user','active')->get();
        return view('admin.Dashboard_Data_User',compact('total_user','total_counselor','data_user'),['chart' => $chart->build(),'counselor_chart' => $counselor_chart->build()]);
    }

    public function dataWebsite()
    {
        $features = Feature::where('status_feature','active')->get();
        $packages = package::where('status_package','active')->get();
        $dataPerusahaan = DataPerusahaan::all()->first();
        $faq = Faq::all();
        $qotd = QOTD::all();
        $coupons = Coupon::all();
        $dataTim = DataTIm::all();
        return view('admin.Dashboard_Data_Website',compact('features','packages','faq','qotd','coupons','dataPerusahaan','dataTim'));
    }

    public function addCounselor(Request $request)
    {
        $foto = $request->foto->getClientOriginalName() . '-' . time()
                    . '.' . $request->foto->extension();
        $request->foto->move(public_path('image_uploaded/image_user'), $foto);

        $counselor = new User();
        $counselor->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $counselor->slug_user = $request->slug_name;
        $counselor->name = $request->username;
        $counselor->email = $request->email;
        $counselor->nama_depan = $request->nama_depan;
        $counselor->nama_belakang = $request->nama_belakang;
        $counselor->gelar_depan = $request->gelar_depan;
        $counselor->gelar_belakang = $request->gelar_belakang;
        $counselor->phone_number = $request->nomor_telepon;
        $counselor->gender = $request->gender;
        $counselor->umur = $request->umur;
        $counselor->bahasa = $request->bahasa;
        $counselor->foto = $foto;
        $counselor->izin_konselor = $request->nomor_izin;
        $counselor->npwp = $request->npwp;
        $counselor->keahlian_utama = $request->keahlian_utama;
        $counselor->keahlian_lainnya = $request->keahlian_lainnya;
        $counselor->pendekatan = $request->pendekatan;
        $counselor->user_type = "konselor";
        $counselor->status_user = 'active';
        $counselor->save();

        return redirect()->back();
    }

    public function updateCounselor(Request $request,$id)
    {
        if($request->hasFile('foto')){
            $foto = $request->foto->getClientOriginalName() . '-' . time()
                    . '.' . $request->foto->extension();
            $request->foto->move(public_path('image_uploaded/image_user'), $foto);
            $counselor = User::find($id);
            $counselor->slug_user = $request->slug_name;
            $counselor->name = $request->username;
            $counselor->email = $request->email;
            $counselor->nama_depan = $request->nama_depan;
            $counselor->nama_belakang = $request->nama_belakang;
            $counselor->gelar_depan = $request->gelar_depan;
            $counselor->gelar_belakang = $request->gelar_belakang;
            $counselor->phone_number = $request->nomor_telepon;
            $counselor->gender = $request->gender;
            $counselor->umur = $request->umur;
            $counselor->bahasa = $request->bahasa;
            $counselor->foto = $foto;
            $counselor->izin_konselor = $request->nomor_izin;
            $counselor->npwp = $request->npwp;
            $counselor->keahlian_utama = $request->keahlian_utama;
            $counselor->keahlian_lainnya = $request->keahlian_lainnya;
            $counselor->pendekatan = $request->pendekatan;
            $counselor->save();
        }else{
            $counselor = User::find($id);
            $counselor->slug_user = $request->slug_name;
            $counselor->name = $request->username;
            $counselor->email = $request->email;
            $counselor->nama_depan = $request->nama_depan;
            $counselor->nama_belakang = $request->nama_belakang;
            $counselor->gelar_depan = $request->gelar_depan;
            $counselor->gelar_belakang = $request->gelar_belakang;
            $counselor->phone_number = $request->nomor_telepon;
            $counselor->gender = $request->gender;
            $counselor->umur = $request->umur;
            $counselor->bahasa = $request->bahasa;
            $counselor->izin_konselor = $request->nomor_izin;
            $counselor->npwp = $request->npwp;
            $counselor->keahlian_utama = $request->keahlian_utama;
            $counselor->keahlian_lainnya = $request->keahlian_lainnya;
            $counselor->pendekatan = $request->pendekatan;
            $counselor->save();
        }
        return redirect()->back();
    }

    public function inactiveUser($id)
    {
        $user = User::find($id);
        $user->status_user = 'inactive';
        $user->save();
        return redirect()->back();
    }

    public function addAdmin(Request $request)
    {
        $admin = new User();
        $admin->uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
        $admin->name = $request->username;
        $admin->slug_user = $request->slug_name;
        $admin->nama_depan = $request->nama_depan;
        $admin->nama_belakang = $request->nama_belakang;
        $admin->email = $request->email;
        $admin->phone_number = $request->nomor_telepon;
        $admin->user_type = 'admin';
        $admin->status_user = 'active';
        $admin->save();

        return redirect()->back();
    }

    public function updateAdmin(Request $request,$id)
    {
        $admin = User::find($id);
        $admin->name = $request->username;
        $admin->slug_user = $request->slug_name;
        $admin->nama_depan = $request->nama_depan;
        $admin->nama_belakang = $request->nama_belakang;
        $admin->email = $request->email;
        $admin->phone_number = $request->nomor_telepon;
        $admin->save();

        return redirect()->back();
    }

    public function EditDataPerusahaan(Request $request)
    {
        $data = new DataPerusahaan();
        $data->nama_perusahaan = $request->nama_perusahaan;
        $data->deskripsi = $request->deskripsi;
        $data->email_perusahaan = $request->email_perusahaan;
        $data->whatsapp_perusahaan = $request->whatsapp_perusahaan;
        $data->alamat_perusahaan = $request->alamat_perusahaan;
        $data->save();

        return redirect()->back();
    }

    public function addTim(Request $request)
    {
        $foto = $request->foto->getClientOriginalName() . '-' . time()
            . '.' . $request->foto->extension();
        $request->foto->move(public_path('image_uploaded/image_tim'), $foto);

        $data = new DataTim();
        $data->foto = $foto;
        $data->nama = $request->nama_anggota;
        $data->divisi = $request->divisi;
        $data->jabatan = $request->jabatan;
        $data->save();

        return redirect()->back();
    }
    public function editTim(Request $request,$id)
    {
        $data = DataTim::find($id);
        if ($request->hasFile('foto')){

            $foto = $request->foto->getClientOriginalName() . '-' . time()
                . '.' . $request->foto->extension();
            $request->foto->move(public_path('image_uploaded/image_tim'), $foto);
        }else{
            $foto = $data->foto;
        }


        $data->foto = $foto;
        $data->nama = $request->nama_anggota;
        $data->divisi = $request->divisi;
        $data->jabatan = $request->jabatan;
        $data->save();

        return redirect()->back();
    }

    public function deleteTim($id)
    {
        $data = DataTim::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function dataTransaksi()
    {
        $dataTransaksi = transaction::all();
        return view('admin.Dashboard_Transaksi',compact('dataTransaksi'));
    }

    public function dataKeuangan()
    {
        $totalPendapatan = counseling::where('status_counseling', 'completed')
        ->selectRaw('COUNT(*) * 125000 AS total_pendapatan, DATE_FORMAT(created_at, "%Y-%m") AS counselingmonth')
        ->groupBy('counselingmonth')
        ->get();
        $allMonthsPendapatan = $totalPendapatan->pluck('counselingmonth')->toArray();

        $totalPendapatanCounselor = counseling::where('status_counseling', 'completed')
        ->selectRaw('(COUNT(*) * 125000) AS total_pendapatan, DATE_FORMAT(created_at, "%Y-%m") AS counselingmonth, counselor_id')
        ->groupBy('counselingmonth', 'counselor_id')
        ->get();

        $totalPendapatanCounselor = $totalPendapatanCounselor->map(function ($item) {
            $counselor = User::find($item->counselor_id);
            $item->counselorname = $counselor->name;
            return $item;
        });


        return view('admin.Dashboard_Data_Gaji',compact('totalPendapatan','allMonthsPendapatan','totalPendapatanCounselor'));
    }
}
