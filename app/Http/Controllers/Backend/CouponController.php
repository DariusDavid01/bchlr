<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function CouponView(){
        $coupons = Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.view_coupon',compact('coupons'));
    }

    public function CouponStore(Request $request){
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
            
        ],
    [
        'coupon_name.required' => 'You have to input the coupon name!',
        'coupon_discount.required' => 'You have to input the discount percentage!',
        'coupon_validity.required' => 'You have to insert the valability date!',
    ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Coupon inserted successfully',
        'alert-type' =>'success');

        return redirect()->back()->with($notification);
    }

    public function CouponEdit($id){
        $coupons = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon',compact('coupons'));
    }

    public function CouponUpdate(Request $request, $id){
        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
    $notification = array('message' => 'Coupon updated successfully',
        'alert-type' =>'info');

        return redirect()->route('manage-coupon')->with($notification);
    }

    public function CouponDelete($id){
        Coupon::findOrFail($id)->delete();
        $notification = array('message' => 'Coupon deleted successfully',
        'alert-type' =>'info');

        return redirect()->back()->with($notification);
    }
}
