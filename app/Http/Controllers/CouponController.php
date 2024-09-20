<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        $coupon = new Coupon();
        $coupon->admin_id = Auth::user()->id;
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount = $request->nominal;
        $coupon->limit = $request->batas;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;
        $coupon->status_coupon = 'active';

        $coupon->save();

        return redirect()->back();
    }

    public function updateCoupon(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount = $request->nominal;
        $coupon->limit = $request->batas;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;

        $coupon->save();

        return redirect()->back();
    }
    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->back();
    }

    public function useCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();
        if(!$coupon){
            return redirect()->back()->with('no_coupon','Kupon Tidak Ada');
        }else{
            return redirect()->back()->with('coupon',$coupon);
        }
    }
}
