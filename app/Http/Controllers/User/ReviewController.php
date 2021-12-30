<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request){
        $product = $request->product_id;
        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'summary' => $request->summary,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Review will be checked by admins',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PendingReview(){
        $review = Review::where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.pending_review',compact('review'));
    }

    public function ReviewApprove($id){
        Review::where('id',$id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Review approved successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PublishReview(){
        $review = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.publish_review',compact('review'));

    }

    public function DeleteReview($id){
        Review::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Review deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
