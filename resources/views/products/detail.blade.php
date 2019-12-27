<?php
use Illuminate\Support\Str;
?>
@extends('layouts.frontLayout.front_design')
@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="index.html"><i class="czi-home"></i>Home</a></li>
                        <li class="breadcrumb-item text-nowrap"><a href="#">Shop</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Product Page v.1</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
                <h1 class="h3 text-light mb-0">{{ $productDetails->name }}</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container">
        <!-- Gallery + details-->
        <div class="bg-light box-shadow-lg rounded-lg px-4 py-3 mb-5">
            <div class="px-lg-3">
                <div class="row">
                    <!-- Product gallery-->
                    <div class="col-lg-7 pr-lg-0 pt-lg-4">
                        <div class="cz-product-gallery">
                            <div class="cz-preview order-sm-2">
                                <div class="cz-preview-item active" id="main-picture-{{ $productDetails->id }}">
                                    @if(!empty($productDetails->image))
                                        <img class="cz-image-zoom" src="{{ asset('backend/images/products/medium/'.$productDetails->image) }}" data-zoom="{{ asset('backend/images/products/large/'.$productDetails->image) }}" alt="{{ $productDetails->name }}">
                                        <div class="cz-image-zoom-pane"></div>
                                    @else
                                        <img class="cz-image-zoom" src="{{ asset('frontend/images/empty-content/empty-product-image.png') }}" data-zoom="{{ asset('frontend/images/empty-content/empty-product-image.png') }}" alt="{{ $productDetails->name }}">
                                    @endif
                                </div>
                                @foreach($productMorePhotos as $key => $morePhotos)
                                    <div class="cz-preview-item" id="picture-{{ $morePhotos->id }}">
                                        <img class="cz-image-zoom" src="{{ asset('backend/images/products/medium/'.$morePhotos->more_photo) }}" data-zoom="{{ asset('backend/images/products/large/'.$morePhotos->more_photo) }}" alt="{{ $productDetails->name }}">
                                        <div class="cz-image-zoom-pane"></div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="cz-thumblist order-sm-1">
                                @if(!empty($productDetails->image))
                                    <a class="cz-thumblist-item active" href="#main-picture-{{ $productDetails->id }}">
                                        <img src="{{ asset('backend/images/products/small/'.$productDetails->image) }}" alt="{{ $productDetails->name }}">
                                    </a>
                                @else
                                    <a class="cz-thumblist-item" href="#picture-{{ $morePhotos->id }}">
                                        <img src="{{ asset('frontend/images/empty-content/empty-product-image.png') }}" alt="{{ $productDetails->name }}">
                                    </a>
                                @endif
                                @foreach($productMorePhotos as $key => $morePhotos)
                                    <a class="cz-thumblist-item" href="#picture-{{ $morePhotos->id }}">
                                        <img src="{{ asset('backend/images/products/small/'.$morePhotos->more_photo) }}" alt="{{ $productDetails->name }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Product details-->
                    <div class="col-lg-5 pt-4 pt-lg-0">
                        <div class="product-details ml-auto pb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2"><a href="#reviews" data-scroll>
                                <span class="d-inline-block font-size-sm text-body align-middle mt-1 ml-1">{{ $productDetails->code }}</span></a>
                                <button class="btn-wishlist mr-0 mr-lg-n3" type="button" data-toggle="tooltip" title="Add to wishlist"><i class="czi-heart"></i></button>
                            </div>
                            <div class="mb-3">
                                <span class="h3 font-weight-normal text-accent mr-1" id="currentPrice">
                                    @if(!empty($productDetails->price))
                                        ${{ $productDetails->price }}
                                    @endif
                                </span>
                            </div>
                            <div class="font-size-sm mb-4"><span class="text-heading font-weight-medium mr-1">Color:</span><span class="text-muted">Red/Dark blue/White</span></div>
                            <div class="position-relative mr-n4 mb-3">
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color" id="color1" checked>
                                    <label class="custom-option-label rounded-circle" for="color1"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-1.png)"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color" id="color2">
                                    <label class="custom-option-label rounded-circle" for="color2"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-2.png)"></span></label>
                                </div>
                                <div class="custom-control custom-option custom-control-inline mb-2">
                                    <input class="custom-control-input" type="radio" name="color" id="color3">
                                    <label class="custom-option-label rounded-circle" for="color3"><span class="custom-option-color rounded-circle" style="background-image: url(img/shop/single/color-opt-3.png)"></span></label>
                                </div>
                                @if($totalStock > 0)
                                    <div class="product-badge product-available mt-n1"><i class="czi-security-check"></i><span id="availability">In Stock</span></div>
                                @else
                                    <div class="product-badge badge-danger mt-n1"><i class="czi-close"></i><span id="availability">Out Of Stock</span></div>
                                @endif
                            </div>
                            <form class="mb-grid-gutter" name="addtocartForm" id="addtocartForm" method="post" action="{{ url('add-cart') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <input type="hidden" name="product_name" value="{{ $productDetails->name }}">
                                <input type="hidden" name="product_code" value="{{ $productDetails->code }}">
                                <input type="hidden" name="price" id="currentPriceSelected" value="{{ $productDetails->price }}">
                                <input type="hidden" name="list_price" value="{{ $productDetails->list_price }}">
                                @if(!empty($productDetails->attributes))
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center pb-1">
                                            <label class="font-weight-medium" for="product-size">Size:</label><a class="nav-link-style font-size-sm" href="#size-chart" data-toggle="modal"><i class="czi-ruler lead align-middle mr-1 mt-n1"></i>Size guide</a>
                                        </div>
                                        <select class="custom-select" name="size" id="product-size" onchange="laravelCMS.getProductAttribute(this)">
                                            <option value="">Select size</option>
                                            @foreach($productDetails->attributes as $sizes)
                                                <option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group d-flex align-items-center">
                                    <select class="custom-select mr-3" name="quantity" style="width: 5rem;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <button class="btn btn-primary btn-shadow btn-block" type="submit">
                                        <i class="czi-cart font-size-lg mr-2"></i>Add to Cart</button>
                                </div>
                            </form>
                            <!-- Product panels-->
                            <div class="accordion mb-4" id="productPanels">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="accordion-heading"><a href="#productInfo" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="productInfo"><i class="czi-announcement text-muted font-size-lg align-middle mt-n1 mr-2"></i>Product info<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                                    </div>
                                    <div class="collapse show" id="productInfo" data-parent="#productPanels">
                                        <div class="card-body">
                                            <h6 class="font-size-sm mb-2">Composition</h6>
                                            <ul class="font-size-sm pl-4">
                                                <li>Elastic rib: Cotton 95%, Elastane 5%</li>
                                                <li>Lining: Cotton 100%</li>
                                                <li>Cotton 80%, Polyester 20%</li>
                                            </ul>
                                            <h6 class="font-size-sm mb-2">Art. No.</h6>
                                            <ul class="font-size-sm pl-4 mb-0">
                                                <li>183260098</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="accordion-heading"><a class="collapsed" href="#shippingOptions" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="czi-delivery text-muted lead align-middle mt-n1 mr-2"></i>Shipping options<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                                    </div>
                                    <div class="collapse" id="shippingOptions" data-parent="#productPanels">
                                        <div class="card-body font-size-sm">
                                            <div class="d-flex justify-content-between border-bottom pb-2">
                                                <div>
                                                    <div class="font-weight-semibold text-dark">Courier</div>
                                                    <div class="font-size-sm text-muted">2 - 4 days</div>
                                                </div>
                                                <div>$26.50</div>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <div>
                                                    <div class="font-weight-semibold text-dark">Local shipping</div>
                                                    <div class="font-size-sm text-muted">up to one week</div>
                                                </div>
                                                <div>$10.00</div>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <div>
                                                    <div class="font-weight-semibold text-dark">Flat rate</div>
                                                    <div class="font-size-sm text-muted">5 - 7 days</div>
                                                </div>
                                                <div>$33.85</div>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom py-2">
                                                <div>
                                                    <div class="font-weight-semibold text-dark">UPS ground shipping</div>
                                                    <div class="font-size-sm text-muted">4 - 6 days</div>
                                                </div>
                                                <div>$18.00</div>
                                            </div>
                                            <div class="d-flex justify-content-between pt-2">
                                                <div>
                                                    <div class="font-weight-semibold text-dark">Local pickup from store</div>
                                                    <div class="font-size-sm text-muted">&mdash;</div>
                                                </div>
                                                <div>$0.00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="accordion-heading"><a class="collapsed" href="#localStore" role="button" data-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i class="czi-location text-muted font-size-lg align-middle mt-n1 mr-2"></i>Find in local store<span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                                    </div>
                                    <div class="collapse" id="localStore" data-parent="#productPanels">
                                        <div class="card-body">
                                            <select class="custom-select">
                                                <option value>Select your country</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="France">France</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Spain">Spain</option>
                                                <option value="UK">United Kingdom</option>
                                                <option value="USA">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sharing-->
                            <h6 class="d-inline-block align-middle font-size-base my-2 mr-2">Share:</h6><a class="share-btn sb-twitter mr-2 my-2" href="#"><i class="czi-twitter"></i>Twitter</a><a class="share-btn sb-instagram mr-2 my-2" href="#"><i class="czi-instagram"></i>Instagram</a><a class="share-btn sb-facebook my-2" href="#"><i class="czi-facebook"></i>Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container mb-4 mb-lg-5">
        <!-- Nav tabs-->
        <ul class="nav nav-tabs" role="tablist">
            @if(!empty($productDetails->description))
                <li class="nav-item"><a class="nav-link p-4 active" href="#description" data-toggle="tab" role="tab">Product description</a></li>
            @endif

            @if(!empty($productDetails->care))
                <li class="nav-item"><a class="nav-link p-4" href="#materials-care" data-toggle="tab" role="tab">Materials & Care</a></li>
            @endif
        </ul>
        <div class="tab-content pt-2">
            <!-- Product details tab-->
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $productDetails->description }}
                    </div>
                </div>
            </div>
            <!-- Reviews tab-->
            <div class="tab-pane fade" id="materials-care" role="tabpanel">
                <!-- Reviews-->
                <div class="row">
                    <div class="col-lg-12">
                        {{ $productDetails->care }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="pb-5">

    <!-- Product carousel (You may also like)-->
    <div class="container pt-lg-2 pb-5 mb-md-3">
        <h2 class="h3 text-center pb-4">You may also like</h2>
        <div class="cz-carousel cz-controls-static cz-controls-outside">
            <div class="cz-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;controls&quot;: true, &quot;nav&quot;: false, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;768&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;items&quot;:4, &quot;gutter&quot;: 30}}}">
                <!-- Product-->
                @foreach($relatedProducts->chunk(3) as $chunk)
                    @foreach($chunk as $item)
                        <div>
                            <div class="card product-card card-static">
                                <button class="btn-wishlist btn-sm" type="button" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="czi-heart"></i></button>
                                <a class="card-img-top d-block overflow-hidden" href="{{ url('product/'.$item->id) }}">
                                    <img src="{{ asset('backend/images/products/medium/'.$item->image) }}" alt="{{ $item->name }}">
                                </a>
                                <div class="card-body py-2">
                                    <a class="product-meta d-block font-size-xs pb-1" href="#">Smartwatches</a>
                                    <h3 class="product-title font-size-sm"><a href="{{ url('product/'.$item->id) }}">{{ $item->name }}</a></h3>
                                    <div class="d-flex justify-content-between">
                                        <div class="product-price"><span class="text-accent">${{ $item->price }}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
