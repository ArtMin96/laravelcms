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
                    <div class="step-label"><i class="czi-cart"></i>Cart</div></a><a class="step-item active current" href="checkout-details.html">
                    <div class="step-progress"><span class="step-count">2</span></div>
                    <div class="step-label"><i class="czi-user-circle"></i>Your details</div></a><a class="step-item" href="checkout-shipping.html">
                    <div class="step-progress"><span class="step-count">3</span></div>
                    <div class="step-label"><i class="czi-package"></i>Shipping</div></a><a class="step-item" href="checkout-payment.html">
                    <div class="step-progress"><span class="step-count">4</span></div>
                    <div class="step-label"><i class="czi-card"></i>Payment</div></a><a class="step-item" href="checkout-review.html">
                    <div class="step-progress"><span class="step-count">5</span></div>
                    <div class="step-label"><i class="czi-check-circle"></i>Review</div></a></div>
            <!-- Autor info-->
            <div class="d-sm-flex justify-content-between align-items-center bg-secondary p-4 rounded-lg mb-grid-gutter">
                <div class="media align-items-center">
                    <div class="media-body pl-3">
                        <h3 class="font-size-base mb-0">{{ Auth::user()->name }}</h3><span class="text-accent font-size-sm">{{ Auth::user()->email }}</span>
                    </div>
                </div><a class="btn btn-light btn-sm btn-shadow mt-3 mt-sm-0" href="account-profile.html"><i class="czi-edit mr-2"></i>Edit profile</a>
            </div>

            <!-- Billing address -->
            <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Billing address</h2>
            <form action="{{ url('/checkout') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="billing-name">Billing Name</label>
                            <input class="form-control" type="text" id="billing-name" name="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="billing-address">Billing Address</label>
                            <input class="form-control" type="text" id="billing-address" name="billing_address" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="billing-phone">Billing Phone</label>
                            <input class="form-control" type="text" id="billing-phone" name="billing_phone" @if(!empty($userDetails->phone)) value="{{ $userDetails->phone }}" @endif>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="billing-pincode">Billing Pincode</label>
                            <input class="form-control" type="text" id="billing-pincode" name="billing_pincode" @if(!empty($userDetails->pincode)) value="{{ $userDetails->pincode }}" @endif>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="billing-city">Billing City</label>
                            <input class="form-control" type="text" id="billing-city" name="billing_city" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="billing-state">Billing State</label>
                            <input class="form-control" type="text" id="billing-state" name="billing_state" @if(!empty($userDetails->state)) value="{{ $userDetails->state }}" @endif>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="billing-country">Billing Country</label>
                            <select id="billing-country" name="billing_country" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" @if(!empty($userDetails->country) && $country->name == $userDetails->country) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6 class="mb-3 py-3 border-bottom">Billing address</h6>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="same-address" onclick="laravelCMS.sameAsShipping(this)" value="{{ $userDetails->name }}">
                    <label class="custom-control-label" for="same-address">Same as shipping address</label>
                </div>

                <!-- Shipping address-->
                <h2 class="h6 pt-1 pb-3 mb-3 mt-5 border-bottom">Shipping address</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping-name">Shipping Name</label>
                            <input class="form-control" type="text" name="shipping_name" @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif id="shipping-name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping-address">Shipping Address</label>
                            <input class="form-control" type="text" name="shipping_address" @if(!empty($shippingDetails->address)) value="{{ $shippingDetails->address }}" @endif id="shipping-address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping-pincode">Shipping Pincode</label>
                            <input class="form-control" type="text" name="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{ $shippingDetails->pincode }}" @endif id="shipping-pincode">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="shipping-phone">Shipping Phone</label>
                            <input class="form-control" type="text" name="shipping_phone" @if(!empty($shippingDetails->phone)) value="{{ $shippingDetails->phone }}" @endif id="shipping-phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="shipping-city">Shipping City</label>
                            <input class="form-control" type="text" name="shipping_city" @if(!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif id="shipping-city">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="shipping-state">Shipping State</label>
                            <input class="form-control" type="text" name="shipping_state" @if(!empty($shippingDetails->state)) value="{{ $shippingDetails->state }}" @endif id="shipping-state">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="shipping-country">Shipping Country</label>
                            <select class="form-control" name="shipping_country" id="shipping-country">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" @if(!empty($shippingDetails->country) && $country->name == $shippingDetails->country) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Navigation (desktop)-->
                <div class="d-none d-lg-flex pt-4 mt-3">
                    <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="shop-cart.html"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to Cart</span><span class="d-inline d-sm-none">Back</span></a></div>
                    <div class="w-50 pl-2">
                        <button class="btn btn-primary btn-block" type="submit">
                            <span class="d-none d-sm-inline">Proceed to Shipping</span><span class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i>
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
                    <div class="media align-items-center pb-2 border-bottom"><a class="d-block mr-2" href="shop-single-v1.html"><img width="64" src="img/shop/cart/widget/01.jpg" alt="Product"/></a>
                        <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Women Colorblock Sneakers</a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2">$150.<small>00</small></span><span class="text-muted">x 1</span></div>
                        </div>
                    </div>
                    <div class="media align-items-center py-2 border-bottom"><a class="d-block mr-2" href="shop-single-v1.html"><img width="64" src="img/shop/cart/widget/02.jpg" alt="Product"/></a>
                        <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">TH Jeans City Backpack</a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2">$79.<small>50</small></span><span class="text-muted">x 1</span></div>
                        </div>
                    </div>
                    <div class="media align-items-center py-2 border-bottom"><a class="d-block mr-2" href="shop-single-v1.html"><img width="64" src="img/shop/cart/widget/03.jpg" alt="Product"/></a>
                        <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">3-Color Sun Stash Hat</a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2">$22.<small>50</small></span><span class="text-muted">x 1</span></div>
                        </div>
                    </div>
                    <div class="media align-items-center py-2 border-bottom"><a class="d-block mr-2" href="shop-single-v1.html"><img width="64" src="img/shop/cart/widget/04.jpg" alt="Product"/></a>
                        <div class="media-body">
                            <h6 class="widget-product-title"><a href="shop-single-v1.html">Cotton Polo Regular Fit</a></h6>
                            <div class="widget-product-meta"><span class="text-accent mr-2">$9.<small>00</small></span><span class="text-muted">x 1</span></div>
                        </div>
                    </div>
                </div>
                <ul class="list-unstyled font-size-sm pb-2 border-bottom">
                    <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Subtotal:</span><span class="text-right">$265.<small>00</small></span></li>
                    <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Shipping:</span><span class="text-right">—</span></li>
                    <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Taxes:</span><span class="text-right">$9.<small>50</small></span></li>
                    <li class="d-flex justify-content-between align-items-center"><span class="mr-2">Discount:</span><span class="text-right">—</span></li>
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
                <div class="w-50 pr-3"><a class="btn btn-secondary btn-block" href="shop-cart.html"><i class="czi-arrow-left mt-sm-0 mr-1"></i><span class="d-none d-sm-inline">Back to Cart</span><span class="d-inline d-sm-none">Back</span></a></div>
                <div class="w-50 pl-2"><a class="btn btn-primary btn-block" href="checkout-shipping.html"><span class="d-none d-sm-inline">Proceed to Shipping</span><span class="d-inline d-sm-none">Next</span><i class="czi-arrow-right mt-sm-0 ml-1"></i></a></div>
            </div>
        </div>
    </div>
</div>
@endsection
