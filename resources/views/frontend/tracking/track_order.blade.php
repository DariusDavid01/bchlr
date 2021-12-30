@extends('frontend.main_master')
@section('content')
@section('title')
Order Tracking
@endsection
<style>
body {
     background-color: #eeeeee;
     font-family: 'Open Sans', serif
 }

 .container {
 }

 .card {
     position: relative;
     display: -webkit-box;
     display: -ms-flexbox;
     display: flex;
     -webkit-box-orient: vertical;
     -webkit-box-direction: normal;
     -ms-flex-direction: column;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid rgba(0, 0, 0, 0.1);
     border-radius: 0.10rem
 }

 .card-header:first-child {
     border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
 }

 .card-header {
     padding: 0.75rem 1.25rem;
     margin-bottom: 0;
     background-color: #fff;
     border-bottom: 1px solid rgba(0, 0, 0, 0.1)
 }

 .track {
     position: relative;
     background-color: #ddd;
     height: 7px;
     display: -webkit-box;
     display: -ms-flexbox;
     display: flex;
     margin-bottom: 60px;
     margin-top: 50px
 }

 .track .step {
     -webkit-box-flex: 1;
     -ms-flex-positive: 1;
     flex-grow: 1;
     width: 25%;
     margin-top: -18px;
     text-align: center;
     position: relative
 }

 .track .step.active:before {
     background: #3822ff
 }

 .track .step::before {
     height: 7px;
     position: absolute;
     content: "";
     width: 100%;
     left: 0;
     top: 18px
 }

 .track .step.active .icon {
     background: #157ed2;
     color: #fff
 }

 .track .icon {
     display: inline-block;
     width: 40px;
     height: 40px;
     line-height: 40px;
     position: relative;
     border-radius: 100%;
     background: #ddd
 }

 .track .step.active .text {
     font-weight: 400;
     color: #000
 }

 .track .text {
     display: block;
     margin-top: 7px
 }

 .itemside {
     position: relative;
     display: -webkit-box;
     display: -ms-flexbox;
     display: flex;
     width: 100%
 }

 .itemside .aside {
     position: relative;
     -ms-flex-negative: 0;
     flex-shrink: 0
 }

 .img-sm {
     width: 80px;
     height: 80px;
     padding: 7px
 }

 ul.row,
 ul.row-sm {
     list-style: none;
     padding: 0
 }

 .itemside .info {
     padding-left: 15px;
     padding-right: 7px
 }

 .itemside .title {
     display: block;
     margin-bottom: 5px;
     color: #212529
 }

 p {
     margin-top: 0;
     margin-bottom: 1rem
 }

 .btn-warning {
     color: #ffffff;
     background-color: #157ed2;
     border-color: #157ed2;
     border-radius: 1px
 }

 .btn-warning:hover {
     color: #ffffff;
     background-color: #0091ff;
     border-color: #0091ff;
     border-radius: 1px
 }

</style>
<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <div class="row" style="margin-left:30px; margin-top:30px">
                <div class="col-md-2">
                    <b>Invoice number</b><br>{{$track->invoice_no}}
                            
                </div>
                <div class="col-md-2">
                <b>Order date</b><br>{{$track->order_date}}
                     
                </div>
                <div class="col-md-2">
                <b>Shipping by {{$track->name}}</b><br>{{$track->division->division_name}} / {{$track->district->district_name}}
                </div>
                <div class="col-md-2">
                <b>User phone number</b><br>{{$track->phone}}
                </div>
                <div class="col-md-2">
                <b>Payment method</b><br>{{$track->payment_method}}
                </div>
                <div class="col-md-2">
                <b>Total amount</b><br>$ {{$track->amount}} 
                </div>
            </div>
            <div class="track">

                @if ($track->status=='pending')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>
                @elseif ($track->status=='confirm')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>
                @elseif ($track->status=='processing')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>
                @elseif ($track->status=='picked')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>
                @elseif ($track->status=='shipped')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>
                @elseif ($track->status=='delivered')
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Pending order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">Confirming order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-box"></i> </span> <span class="text">Processing order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-dolly"></i></span> <span class="text">Picked order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">Shipped order</span> </div>
                <div class="step active"> <span class="icon"> <i class="fas fa-clipboard-check"></i> </span> <span class="text">Delivered order</span> </div>

                @endif
                
                
            </div>
            <hr>
            <a href="{{route('my.orders')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
        <br><br>
        </div>
    </article>
</div>


@endsection