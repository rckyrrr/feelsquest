<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestQuestion;
use App\Models\TestResult;
use App\Models\Test;
use App\Models\counseling;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('user.Test_Kesehatan_Mental',compact('tests'));

    }

    public function test(Request $request)
    {
        $test_uuid = $request->test_id;
        $test = Test::where('test_uuid',$request->test_id)->first();
        $bai = TestQuestion::where('test_id',$test->id)->get();
        return view('user.Test_BDI',compact('bai','test','test_uuid'));
    }

    public function testResultBai(Request $request)
    {
        $test = Test::where('test_uuid',$request->test_id)->first();
        $transaction = transaction::where('klien_id', Auth::user()->id)->where('transaction_status','ongoing')->first();
        $answers = $request->input('answer', []);
        $totalScore = 0;

        foreach ($answers as $index => $answer) {
            $totalScore += intval($answer);
        }
        if(count((array)$answers) == 29 || count((array)$answers) == 21){
            if($transaction){
                $counseling = counseling::where('transaction_id',$transaction->id)->latest()->first();
                $result = new TestResult();
                $result->klien_id = Auth::user()->id;
                $result->testResult_uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
                $result->counselor_id = $counseling->counselor_id;
                $result->test_id = $test->id;
                $result->answer = json_encode($answers);
                $result->score = $totalScore;
                $result->status_result = 'withCounselor';
                $result->save();
            }else{
                $result = new TestResult();
                $result->testResult_uuid = str_replace('-', '', substr(Str::uuid(), 0, 16));
                $result->klien_id = Auth::user()->id;
                $result->test_id = $test->id;
                $result->answer = json_encode($answers);
                $result->score = $totalScore;
                $result->status_result = 'noCounselor';
                $result->save();
            }

            return redirect('/tes-mental/user');
        }else{

            $errorMessage = "Masih Ada Pertanyaan Yang Tidak Terjawab.";
            return back()->withInput()->withErrors(['missing_answers' => $errorMessage]);

            // return back()->withInput();
        }


    }
}
