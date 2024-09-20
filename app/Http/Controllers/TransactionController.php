<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\User;
use App\Models\package;
use App\Models\counseling;
use App\Models\Coupon;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = transaction::where('klien_id',Auth::user()->id)->get();
        return view('user.Transaksi',compact('transactions'));
    }

    public function invoice(Request $request)
    {
        $transaction = transaction::where('transactionUUID',$request->transaction)->first();
        $counseling = counseling::where('transaction_id', $transaction->id)->first();
        $counselingDate = Carbon::parse($counseling->counseling_date)->format('d F Y');
        $dateNow = Carbon::now()->setTimezone('Asia/Jakarta');

        if($transaction->payment_status == 'unpaid'){
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            if (session('coupon')){
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $transaction->transactionUUID,
                        'gross_amount' => $transaction->gross_amount - session('coupon')->discount,
                    ),
                    'customer_details' => array(
                        'name' => Auth::user()->name,
                        'email'=> Auth::user()->email,
                        'phone' => Auth::user()->phone_number,
                    ),
                );
            }else{
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $transaction->transactionUUID,
                        'gross_amount' => $transaction->gross_amount,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'email'=> Auth::user()->email,
                        'phone' => Auth::user()->phone_number,
                    ),
                );
            }

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return view('user.Pembayaran',compact('snapToken','transaction','counseling','dateNow','counselingDate'));
        }
        return view('user.Pembayaran',compact('transaction','counseling','dateNow','counselingDate'));


    }

    public function payment_success(Request $request)
    {
        if($request->coupon){
            $coupon = Coupon::where('code', $request->coupon)->first();
            $coupon->limit = $coupon->limit -1;
            $coupon->save();
            $transaction = transaction::where('transactionUUID',$request->transaction)->first();
            $transaction->gross_amount = $transaction->gross_amount - $coupon->discount;
            $transaction->save();
            $counseling = counseling::where('transaction_id', $transaction->id)->first();
            $counselingDate = Carbon::parse($counseling->counseling_date)->format('d F Y');
            $testResult = TestResult::where('klien_id',Auth::user()->id)->where('status_result','noCounselor')->get();
            foreach($testResult as $result){
                $result->counselor_id = $counseling->counselor_id;
                $result->status_result = 'withCounselor';
                $result->save();
            }
            $dateNow = Carbon::now()->setTimezone('Asia/Jakarta');
            return view('user.Pembayaran',compact('transaction','counseling','dateNow','counselingDate','coupon'));
        }else{
            $transaction = transaction::where('transactionUUID',$request->transaction)->first();
            $counseling = counseling::where('transaction_id', $transaction->id)->first();
            $counselingDate = Carbon::parse($counseling->counseling_date)->format('d F Y');
            $dateNow = Carbon::now()->setTimezone('Asia/Jakarta');
            $testResult = TestResult::where('klien_id',Auth::user()->id)->where('status_result','noCounselor')->get();
            foreach($testResult as $result){
                $result->counselor_id = $counseling->counselor_id;
                $result->status_result = 'withCounselor';
                $result->save();
            }
            return view('user.Pembayaran',compact('transaction','counseling','dateNow','counselingDate'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createInvoice(Request $request)
    {
        $packageID = $request->packageID;
        $package = package::where('packageUUID',$packageID)->first();
        $counselorID = $request->counselorID;
        $counselor = User::where('uuid',$counselorID)->first();
        $date = Carbon::now()->setTimezone('Asia/Jakarta')->format('Ymd');
        $number = rand(00000000,99999999);

        $transaction = new transaction();
        $transaction->transactionUUID = $date.$number;
        $transaction->package_id = $package->id;
        $transaction->klien_id = Auth::user()->id;
        $transaction->gross_amount = $package->price;
        $transaction->session_remaining = $package->total_sessions - 1;
        $transaction->payment_status = 'unpaid';
        $transaction->transaction_status = 'pending';
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
        $counseling->status_counseling = 'waiting payment';
        $counseling->save();

        return redirect('/transaksi/payment?transaction='.$transaction->transactionUUID);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $transaction = transaction::where('transactionUUID',$request->order_id)->first();
                $transaction->payment_status = 'paid';
                $transaction->transaction_status = 'ongoing';
                $transaction->save();

                $counseling = counseling::where('transaction_id',$transaction->id)->first();
                $counseling->status_counseling = 'scheduled';
                $counseling->save();

            }
        }
    }

    public function cancel($id)
    {
        $transaction = transaction::find($id);
        $transaction->payment_status = 'cancelled';
        $transaction->save();
        $counseling = counseling::where('transaction_id',$transaction->id)->first();
        $counseling->status_counseling = 'cancelled';
        $counseling->save();

        return redirect('/dashboard/user');
    }

    public function generatePDF($uuid)
    {

        $transaction = Transaction::where('transactionUUID',$uuid)->first();
        $data = [
            'transaction' => $transaction,
        ];

        // Menghasilkan tampilan HTML
        $html = view('admin.Invoice', $data);

        // Menghasilkan PDF dari HTML dengan gambar
        $pdf = PDF::loadHTML($html)->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        // Mengembalikan PDF sebagai respons
        return $pdf->stream('example.pdf');
    }
}
