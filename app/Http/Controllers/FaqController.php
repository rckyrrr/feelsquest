<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index(){
        $faq = Faq::all();
        return view('user.FAQ',compact('faq'));
    }

    public function addFAQ(Request $request)
    {
        $faq = new Faq();
        $faq->admin_id = Auth::user()->id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->back();
    }

    public function deleteFAQ($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        return redirect()->back();
    }
    public function updateFAQ(Request $request,$id)
    {
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->back();
    }
}
