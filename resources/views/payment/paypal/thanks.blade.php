@extends('layouts.frontLayout.front_design')

@section('content')
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h2 class="h4 pb-3">Thank you for your order! PayPal</h2>
                    <p class="font-size-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                    <p class="font-size-sm mb-2">Make sure you make note of your order number, which is <span class='font-weight-medium'>{{ Session::get('order_id') }}</span> and total payable is <span class='font-weight-medium'>${{ Session::get('grand_total') }}</span></p>
                    <p class="font-size-sm">You will be receiving an email shortly with confirmation of your order. <u>You can now:</u></p><a class="btn btn-secondary mt-3 mr-3" href="shop-grid-ls.html">Go back shopping</a><a class="btn btn-primary mt-3" href="order-tracking.html"><i class="czi-location"></i>&nbsp;Track order</a>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
Session::forget('order_id');
Session::forget('grand_total');
?>
