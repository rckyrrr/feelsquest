<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QOTD;
use Illuminate\Support\Facades\Auth;



class QOTDController extends Controller
{
    public function addQOTD(Request $request)
    {
        $qotd = new QOTD();
        $qotd->admin_id = Auth::user()->id;
        $qotd->qotd = $request->qotd;
        $qotd->save();

        return redirect()->back();
    }

    public function deleteQOTD($id)
    {
        $qotd = QOTD::find($id);
        $qotd->delete();
        return redirect()->back();
    }

    public function updateQOTD(Request $request,$id)
    {
        $qotd = QOTD::find($id);
        $qotd->qotd = $request->qotd;
        $qotd->save();
        return redirect()->back();
    }
}
