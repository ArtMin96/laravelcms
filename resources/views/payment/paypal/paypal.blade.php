@extends('layouts.frontLayout.front_design')

@section('content')
    <?php use App\Order; ?>
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">
                <div class="card-body text-center">
                    <h2 class="h4 pb-3">Thank you for your order!</h2>

                    <?php
                    $orderDetails = Order::getOrderDetails(Session::get('order_id'));
                    $nameArr = explode(' ', $orderDetails->name);
                    $getCountryCode = Order::getCountryCode($orderDetails->country);
                    ?>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="POST">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="artminasyanart96@inbox.ru">
{{--                        <input type="hidden" name="business" value="sb-hof3t823428@business.example.com">--}}
                        <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                        <input type="hidden" name="amount" value="{{ Session::get('grand_total') }}">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="first_name" value="{{ $nameArr[0] }}">
                        <input type="hidden" name="last_name" value="{{ $nameArr[1] }}">
                        <input type="hidden" name="address1" value="{{ $orderDetails->address }}">
                        <input type="hidden" name="address2" value="">
                        <input type="hidden" name="city" value="{{ $orderDetails->city }}">
                        <input type="hidden" name="state" value="{{ $orderDetails->state }}">
                        <input type="hidden" name="zip" value="{{ $orderDetails->pincode }}">
                        <input type="hidden" name="email" value="{{ $orderDetails->user_email }}">
                        <input type="hidden" name="country" value="{{ $getCountryCode->iso2 }}">
                        <input type="hidden" name="return" value="{{ url('paypal/thanks') }}">
                        <input type="hidden" name="cancel_return" value="{{ url('paypal/cancel') }}">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
                        <img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<?php
//Session::forget('order_id');
//Session::forget('grand_total');
?>
