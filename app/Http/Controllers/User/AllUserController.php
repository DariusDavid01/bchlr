<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use PDF;

class AllUserController extends Controller
{
    public function MyOrders(){
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_view',compact('orders'));
    }

    public function OrderDetails($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','orderItem'));
    }

    public function InvoiceDownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice_' . $order->invoice_no . '.pdf');
        //return $pdf->stream();
    }

    public function ReturnOrder(Request $request, $order_id){
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return request send successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('my.orders')->with($notification);
    }

    public function ReturnOrderList(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.user.order.return_order_view',compact('orders'));
    }

    public function CancelOrders(){
        $orders = Order::where('user_id',Auth::id())->where('status','canceled')->orderBy('id','DESC')->get();
        return view('frontend.user.order.cancel_order_view',compact('orders'));
    }


    //order tracking
    public function OrderTracking(Request $request){
        $invoice = $request->code;
        $track = Order::where('invoice_no',$invoice)->first();
        if ($track){
            return view('frontend.tracking.track_order',compact('track'));
        }else{
            $notification = array(
                'message' => 'Invoice code is not valid',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }
    }
}
