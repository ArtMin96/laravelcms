@extends('layouts.frontLayout.front_design')

@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="shop-grid-ls.html">Shop</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">Checkout</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <section class="col-lg-8">
                <!-- Steps-->
                <div class="steps steps-light pt-2 pb-3 mb-5"><a class="step-item active" href="shop-cart.html">
                        <div class="step-progress"><span class="step-count">1</span></div>
                        <div class="step-label"><i class="czi-cart"></i>Cart</div></a><a class="step-item active" href="checkout-details.html">
                        <div class="step-progress"><span class="step-count">2</span></div>
                        <div class="step-label"><i class="czi-user-circle"></i>Your details</div></a><a class="step-item active current" href="checkout-shipping.html">
                        <div class="step-progress"><span class="step-count">3</span></div>
                        <div class="step-label"><i class="czi-package"></i>Shipping</div></a><a class="step-item" href="checkout-payment.html">
                        <div class="step-progress"><span class="step-count">4</span></div>
                        <div class="step-label"><i class="czi-card"></i>Payment</div></a><a class="step-item" href="checkout-review.html">
                        <div class="step-progress"><span class="step-count">5</span></div>
                        <div class="step-label"><i class="czi-check-circle"></i>Review</div></a></div>
                <!-- Shipping methods table-->
                <h2 class="h6 pb-3 mb-2">Choose billing or shipping method</h2>

                <div class="row my-4 pb-3">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="media">
                                        <div class="custom-control custom-radio mt-2 mb-0">
                                            <input class="custom-control-input" type="radio" id="billing-address" name="radio">
                                            <label class="custom-control-label" for="billing-address"></label>
                                        </div>
                                        <div class="media-body pl-3">
                                            <span class="font-size-md font-weight-bold">{{ $userDetails->name }}, {{ $userDetails->phone }}</span>
                                            <span class="d-block text-heading font-size-sm">{{ $userDetails->address }}</span>
                                            <span class="d-block text-heading font-size-sm">{{ $userDetails->city }}, {{ $userDetails->state }}, {{ $userDetails->country }}, {{ $userDetails->pincode }}</span>
                                            <span class="badge badge-primary badge-shadow mt-3">Billing</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="media">
                                        <div class="custom-control custom-radio mt-2 mb-0">
                                            <input class="custom-control-input" type="radio" id="shipping-address" name="radio">
                                            <label class="custom-control-label" for="shipping-address"></label>
                                        </div>
                                        <div class="media-body pl-3">
                                            <span class="font-size-md font-weight-bold">{{ $shippingDetails->name }}, {{ $shippingDetails->phone }}</span>
                                            <span class="d-block text-heading font-size-sm">{{ $shippingDetails->address }}</span>
                                            <span class="d-block text-heading font-size-sm">{{ $shippingDetails->city }}, {{ $shippingDetails->state }}, {{ $shippingDetails->country }}, {{ $shippingDetails->pincode }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Review your order</h2>
                <!-- Item-->
                <?php $totalAmount = 0; ?>
                @foreach($userCart as $cart)
                    <div class="d-sm-flex justify-content-between my-4 pb-3 border-bottom">
                        <div class="media media-ie-fix d-block d-sm-flex text-center text-sm-left">
                            <a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;"><img src="{{ asset('backend/images/products/small/'.$cart->image) }}" alt="{{ $cart->product_name }}"></a>
                            <div class="media-body pt-2">
                                <h3 class="product-title font-size-base mb-2"><a href="shop-single-v1.html">{{ $cart->product_name }}</a></h3>
                                <div class="font-size-sm"><span class="text-muted mr-2">Code:</span>{{ $cart->product_code }}</div>
                                <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>{{ $cart->size }}</div>
                                <div class="font-size-lg text-accent pt-2">${{ $cart->price }} - {{ $cart->price * $cart->quantity }}</div>
                            </div>
                        </div>
                        <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-right" style="max-width: 9rem;">
                            <p class="mb-0"><span class="text-muted font-size-sm">Quantity:</span><span>&nbsp;{{ $cart->quantity }}</span></p>
                            <button class="btn btn-link px-0" type="button"><i class="czi-edit mr-2"></i><span class="font-size-sm">Edit</span></button>
                        </div>
                    </div>
                <?php $totalAmount = $totalAmount + $cart->price * $cart->quantity; ?>
                @endforeach

                <?php $grandTotal = $totalAmount - Session::get('CouponAmount') ?>

                <h2 class="h6 pb-3 mb-2">Choose payment method</h2>
                <form action="{{ url('/place-order') }}" method="POST" name="paymentForm" id="paymentForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                    <div class="row my-4 pb-3">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="custom-control custom-radio mb-0">
                                                <input class="custom-control-input" type="radio" id="PayPal" value="PayPal" name="payment_method">
                                                <label class="custom-control-label" for="PayPal"></label>
                                            </div>
                                            <div class="media-body pl-3">
                                            <span class="font-size-md font-weight-bold">
                                                <img src="{{ asset('frontend/images/payments/9_bdg_secured_by_pp_2line.png') }}" alt="Paypal" width="62" class="v-middle mr-4">
                                                PayPal</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="custom-control custom-radio mb-0">
                                                <input class="custom-control-input" type="radio" id="COD" value="COD" name="payment_method">
                                                <label class="custom-control-label" for="COD"></label>
                                            </div>
                                            <div class="media-body pl-3">
                                            <span class="font-size-md font-weight-bold">
                                                <img src="{{ asset('frontend/images/payments/9_bdg_secured_by_pp_2line.png') }}" alt="COD" width="62" class="v-middle mr-4">
                                                COD</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Navigation (desktop)-->
                    <div class="d-none d-lg-flex pt-4">
                        <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="checkout-details.html"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to Adresses</span><span class="d-inline d-sm-none">Back</span></a></div>
                        <div class="w-50 pl-2">
                            <button class="btn btn-primary btn-block" type="submit" onclick="laravelCMS.selectPaymentMethod()">
                                <span class="d-none d-sm-inline">Place Order</span><span class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto">
                    <div class="widget mb-3">
                        <h2 class="widget-title text-center">Order summary</h2>
                    </div>
                    <ul class="list-unstyled font-size-sm pb-2 border-bottom">
                        <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Subtotal:</span><span class="text-right">${{ $totalAmount }}</span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Shipping:</span><span class="text-right">—</span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Discount:</span><span class="text-right">@if(!empty(Session::get('CouponAmount'))) {{ Session::get('CouponAmount') }} @else — @endif</span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Grand Total:</span><span class="text-right">${{ $totalAmount - Session::get('CouponAmount') }}</span></li>
                    </ul>
                    <h3 class="font-weight-normal text-center my-4">$274.<small>50</small></h3>
                    <form class="needs-validation" method="post" novalidate>
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Promo code" required>
                            <div class="invalid-feedback">Please provide promo code.</div>
                        </div>
                        <button class="btn btn-outline-primary btn-block" type="submit">Apply promo code</button>
                    </form>
                </div>
            </aside>
        </div>
        <!-- Navigation (mobile)-->
        <div class="row d-lg-none">
            <div class="col-lg-8">
                <div class="d-flex pt-4 mt-3">
                    <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="checkout-details.html"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to Adresses</span><span class="d-inline d-sm-none">Back</span></a></div>
                    <div class="w-50 pl-2"><a class="btn btn-primary btn-block" href="checkout-payment.html"><span class="d-none d-sm-inline">Proceed to Payment</span><span class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
