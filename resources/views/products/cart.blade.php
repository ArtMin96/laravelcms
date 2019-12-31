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
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">Your cart</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-2 pb-sm-5 mt-1">
                    <h2 class="h6 text-light mb-0">Products</h2><a class="btn btn-outline-primary btn-sm pl-2" href="shop-grid-ls.html"><i class="czi-arrow-left mr-2"></i>Continue shopping</a>
                </div>
                <!-- Item-->
                <?php $totalAmount = 0; ?>
                @foreach($userCart as $cart)
                <div class="d-sm-flex justify-content-between align-items-center my-4 pb-3 border-bottom">
                    <div class="media media-ie-fix d-block d-sm-flex align-items-center text-center text-sm-left">
                        <a class="d-inline-block mx-auto mr-sm-4" href="shop-single-v1.html" style="width: 10rem;">
                            <img src="{{ asset('backend/images/products/small/'.$cart->image) }}" alt="{{ $cart->product_name }}">
                        </a>
                        <div class="media-body pt-2">
                            <h3 class="product-title font-size-base mb-2"><a href="#">{{ $cart->product_name }}</a></h3>
                            <div class="font-size-sm"><span class="text-muted mr-2">Code:</span>{{ $cart->product_code }}</div>
                            <div class="font-size-sm"><span class="text-muted mr-2">Size:</span>{{ $cart->size }}</div>
                            <div class="font-size-lg text-accent pt-2">${{ $cart->price }} - {{ $cart->price * $cart->quantity }}</div>
                        </div>
                    </div>
                    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left" style="max-width: 9rem;">
                        <div class="form-group mb-0">
                            <label class="font-weight-medium" for="quantity">Quantity</label>
                            <div class="btn-group" role="group" aria-label="Settings group">
                                @if($cart->quantity > 1)
                                    <a href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}" class="btn btn-secondary btn-sm btn-icon">
                                        <i class="czi-arrow-down"></i>
                                    </a>
                                @endif
                                <input class="form-control" type="text" id="quantity" name="quantity" value="{{ $cart->quantity }}">
                                <a href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}" class="btn btn-primary btn-sm btn-icon">
                                    <i class="czi-arrow-up"></i>
                                </a>
                            </div>
                        </div>
                        <a href="{{ url('/cart/delete-product/'.$cart->id) }}" class="btn btn-link px-0 text-danger">
                            <i class="czi-close-circle mr-2"></i>
                            <span class="font-size-sm">Remove</span>
                        </a>
                    </div>
                </div>
                    <?php $totalAmount = $totalAmount + $cart->price * $cart->quantity; ?>
                @endforeach
                <button class="btn btn-outline-accent btn-block" type="button"><i class="czi-loading font-size-base mr-2"></i>Update cart</button>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-4 pt-4 pt-lg-0">
                <div class="cz-sidebar-static rounded-lg box-shadow-lg ml-lg-auto">
                    <div class="text-center mb-4 pb-3 border-bottom">
                        @if(!empty(Session::get('CouponAmount')))
                            <h2 class="h6 mb-3 pb-1">Subtotal</h2>
                            <h3 class="font-weight-normal">$<?= $totalAmount; ?></h3>
                            <h2 class="h6 mb-3 pb-1">Coupon Discount</h2>
                            <h3 class="font-weight-normal">$@convert(Session::get('CouponAmount'))</h3>
                            <h2 class="h6 mb-3 pb-1">Grand Total</h2>
                            <h3 class="font-weight-normal">$@convert($totalAmount - Session::get('CouponAmount'))</h3>
                        @else
                            <h2 class="h6 mb-3 pb-1">Grand Total</h2>
                            <h3 class="font-weight-normal">$<?= $totalAmount; ?></h3>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label class="mb-3" for="order-comments"><span class="badge badge-info font-size-xs mr-2">Note</span><span class="font-weight-medium">Additional comments</span></label>
                        <textarea class="form-control" rows="6" id="order-comments"></textarea>
                    </div>
                    <div class="accordion" id="order-options">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="accordion-heading"><a href="#promo-code" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="promo-code">Apply promo code<span class="accordion-indicator"></span></a></h3>
                            </div>
                            <div class="collapse show" id="promo-code" data-parent="#order-options">
                                <form class="card-body needs-validation" method="post" action="{{ url('cart/apply-coupon') }}" novalidate>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="coupon_code" placeholder="Promo code">
                                        <div class="invalid-feedback">Please provide promo code.</div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-block" type="submit">Apply promo code</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="accordion-heading"><a class="collapsed" href="#shipping-estimates" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="shipping-estimates">Shipping estimates<span class="accordion-indicator"></span></a></h3>
                            </div>
                            <div class="collapse" id="shipping-estimates" data-parent="#order-options">
                                <div class="card-body">
                                    <form class="needs-validation" novalidate>
                                        <div class="form-group">
                                            <select class="form-control custom-select" required>
                                                <option value="">Choose your country</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Finland">Finland</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="United States">United States</option>
                                            </select>
                                            <div class="invalid-feedback">Please choose your country!</div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control custom-select" required>
                                                <option value="">Choose your city</option>
                                                <option value="Bern">Bern</option>
                                                <option value="Brussels">Brussels</option>
                                                <option value="Canberra">Canberra</option>
                                                <option value="Helsinki">Helsinki</option>
                                                <option value="Mexico City">Mexico City</option>
                                                <option value="Ottawa">Ottawa</option>
                                                <option value="Washington D.C.">Washington D.C.</option>
                                                <option value="Wellington">Wellington</option>
                                            </select>
                                            <div class="invalid-feedback">Please choose your city!</div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="ZIP / Postal code" required>
                                            <div class="invalid-feedback">Please provide a valid zip!</div>
                                        </div>
                                        <button class="btn btn-outline-primary btn-block" type="submit">Calculate shipping</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><a class="btn btn-primary btn-shadow btn-block mt-4" href="{{ url('/checkout') }}"><i class="czi-card font-size-lg mr-2"></i>Proceed to Checkout</a>
                </div>
            </aside>
        </div>
    </div>
@endsection
