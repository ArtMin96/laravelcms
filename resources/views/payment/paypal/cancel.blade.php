@extends('layouts.frontLayout.front_design')

@section('content')
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h2 class="h4 pb-3">Your order has been canceled! PayPal</h2>
                    <p class="font-size-sm mb-2">Please contact us if there is any enquiry.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
Session::forget('order_id');
Session::forget('grand_total');
?>
